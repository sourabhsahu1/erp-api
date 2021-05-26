<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use App\Services\WKHTMLPDfConverter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyInformation;
use Modules\Admin\Models\CompanySetting;
use Modules\Admin\Models\Tax;
use Modules\Treasury\Models\Aie;
use Modules\Treasury\Models\Cashbook;
use Modules\Treasury\Models\DefaultSetting;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentApproval;
use Modules\Treasury\Models\PaymentApprovalPayee;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\RetireLiability;
use Modules\Treasury\Models\RetireVoucher;
use Modules\Treasury\Models\ScheduleEconomic;
use Modules\Treasury\Models\VoucherSourceUnit;

class PaymentRepository extends EloquentBaseRepository
{
    public $model = PaymentVoucher::class;

    public function create($data)
    {

        $paymentV = PaymentVoucher::latest()->orderby('id', 'desc')->first();

        DB::beginTransaction();
        try {
            if (is_null($paymentV)) {
                $data['data']['deptal_id'] = 1;
            } else {
                $data['data']['deptal_id'] = $paymentV->deptal_id + 1;
            }
            $data['data']['status'] = 'NEW';


            /** @var CompanySetting $companySetting */
            $companySetting = CompanySetting::find(1);
            $data['data']['is_payment_approval'] = $companySetting->is_payment_approval;

            if ($companySetting->is_payment_approval == true) {
                Log::info($companySetting->is_payment_approval);
                if (!isset($data['data']['payment_approve_id'])) {
                    throw new AppException('Payment Approve Id is required');
                }
                /** @var PaymentVoucher $paymentVoucher */
                $paymentVoucher = parent::create($data);

                $paymentApproval = PaymentApproval::with([
                    'payment_approval_payees'
                ])->find($paymentVoucher->payment_approve_id);

                /** @var PaymentApprovalPayee $approval_payee */
                foreach ($paymentApproval->payment_approval_payees as $approval_payee) {
                    $employeeId = $approval_payee->employee_id;
                    $companyId = $approval_payee->company_id;
                    foreach ($data['data']['payees'] as $payee) {

                        /** @var PaymentApprovalPayee $approvalPayee */
                        $approvalPayee = PaymentApprovalPayee::find($payee['id']);
                        if (is_null($approvalPayee->company_id)) {
                            $payeeId = $approvalPayee->employee_id;
                        } else {
                            $payeeId = $approvalPayee->company_id;
                        }

                        if (($payeeId === $employeeId) || ($payeeId === $companyId)) {
                            //todo payee create and deduction in payment approval payee amount
                            $taxes = Tax::whereIn('id', json_decode($approval_payee->tax_ids, true))->pluck('tax')->all();

                            $totalTax = array_sum($taxes);
                            //check to make sure amount is well balanced in both
                            $remainingAmount = $approval_payee->remaining_amount - $payee['amount'];

                            if ($remainingAmount < 0) {
                                throw new AppException('Remaining amount is zero');
                            }
                            if ($remainingAmount == 0) {
                                $paymentApproval->status = AppConstant::PAYMENT_APPROVAL_FULLY_USED;
                                $paymentApproval->save();
                            }
                            if ($remainingAmount > 0) {
                                $paymentApproval->status = AppConstant::PAYMENT_APPROVAL_READY_FOR_PV;
                                $paymentApproval->save();
                            }


                            $payeeVoucher = PayeeVoucher::create([
                                'payment_voucher_id' => $paymentVoucher->id,
                                'employee_id' => $employeeId,
                                'company_id' => $companyId,
                                'net_amount' => $payee['amount'],
                                'total_tax' => ($totalTax * $payee['amount']) / 100,
                                'year' => $approval_payee->year,
                                'details' => $approval_payee->details,
                                'tax_ids' => $approval_payee->tax_ids
                            ]);

                            PaymentApprovalPayee::where('id', $approval_payee->id)->update([
                                'remaining_amount' => $remainingAmount
                            ]);
                        } else {
                            Log::info('else statement');
                            continue;
                        }
                    }
                }
                DB::commit();
                return $paymentVoucher;
            } elseif ($companySetting->is_payment_approval == false) {
                /** @var PaymentVoucher $paymentVoucher */
                $paymentVoucher = parent::create($data);
                $paymentApproval = PaymentApproval::create([
                    'admin_segment_id' => $paymentVoucher->admin_segment_id,
                    'fund_segment_id' => $paymentVoucher->fund_segment_id,
                    'economic_segment_id' => $paymentVoucher->economic_segment_id,
                    'employee_customer' => $paymentVoucher->payee,
                    'prepared_by_id' => $paymentVoucher->checking_officer_id,
                    'authorised_by_id' => $paymentVoucher->checking_officer_id,
                    'currency_id' => $paymentVoucher->currency_id,
                    'value_date' => $paymentVoucher->value_date,
                    'authorised_date' => Carbon::now()->toDateTimeString(),
                    'remark' => $paymentVoucher->payment_description,
                    'status' => AppConstant::PAYMENT_APPROVAL_FULLY_USED
                ]);

                $pv = PaymentVoucher::where('id', $paymentVoucher->id)->update([
                    'payment_approve_id' => $paymentApproval->id
                ]);
            }


            DB::commit();
            return $paymentVoucher;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function update($data)
    {
        /** @var PaymentVoucher $paymentVoucher */
        $paymentVoucher = PaymentVoucher::with('payee_vouchers')->find($data['id']);

        $data['data']['status'] = $paymentVoucher->status;
        $data['data']['type'] = $paymentVoucher->type;

        if ($paymentVoucher->is_payment_approval === true) {

            $paymentApproval = PaymentApproval::with([
                'payment_approval_payees'
            ])->find($paymentVoucher->payment_approve_id);

            if ($paymentApproval) {
                /** @var PaymentApprovalPayee $approval_payee */
                foreach ($paymentApproval->payment_approval_payees as $approval_payee) {
                    $employeeId = $approval_payee->employee_id;
                    $companyId = $approval_payee->company_id;
                    foreach ($data['data']['payees'] as $payee) {

                        /** @var PaymentApprovalPayee $approvalPayee */
                        $approvalPayee = PaymentApprovalPayee::find($payee['id']);
                        if (!$approvalPayee) {
                            throw new AppException("Approval Payee not exist");
                        } elseif (is_null($approvalPayee->company_id)) {
                            $payeeId = $approvalPayee->employee_id;
                        } else {
                            $payeeId = $approvalPayee->company_id;
                        }
                        if (($payeeId === $employeeId) || ($payeeId === $companyId)) {
                            //todo payee create and deduction in payment approval payee amount
                            $taxes = Tax::whereIn('id', json_decode($approval_payee->tax_ids, true))->pluck('tax')->all();

                            $totalTax = array_sum($taxes);
                            //check to make sure amount is well balanced in both
                            $remainingAmount = $approval_payee->remaining_amount - $payee['amount'];
                            if ($remainingAmount == 0) {
                                throw new AppException('Payment Approval has zero amount');
                            }
                            $pv = parent::update($data);

                            if ($remainingAmount < 0) {
                                continue;
                            }

                            $payeeVoucher = PayeeVoucher::where('payment_voucher_id', $paymentVoucher->id)
                                ->where('employee_id', $employeeId)
                                ->where('company_id', $companyId)
                                ->first();

                            $updatedRemainingAmount = $payee['amount'] - $payeeVoucher->net_amount;

                            PayeeVoucher::where('payment_voucher_id', $paymentVoucher->id)
                                ->where('employee_id', $employeeId)
                                ->where('company_id', $companyId)
                                ->update([
                                    'net_amount' => $payee['amount'],
                                    'total_tax' => ($totalTax * $payee['amount']) / 100,
                                ]);

                            PaymentApprovalPayee::where('id', $approval_payee->id)->update([
                                'remaining_amount' => $approvalPayee->remaining_amount - $updatedRemainingAmount
                            ]);


                        } else {
                            continue;
                        }
                    }
                }
            } else {


            }


            return $paymentVoucher;
        }
        return parent::update($data);
    }

    public function delete($data)
    {

        DB::beginTransaction();
        try {
            /** @var PaymentVoucher $paymentVoucher */
            $paymentVoucher = PaymentVoucher::with('payee_vouchers')->find($data['id']);

            if ($paymentVoucher->status !== AppConstant::VOUCHER_STATUS_NEW) {
                throw new AppException('Cannot delete status is not New');
            } else {
                if ($paymentVoucher->is_payment_approval === true) {
                    $paymentApproval = PaymentApproval::with([
                        'payment_approval_payees'
                    ])->find($paymentVoucher->payment_approve_id);

                    /** @var PaymentApprovalPayee $approval_payee */

                    $remAmount = 0;
                    $amount = 0;
                    foreach ($paymentApproval->payment_approval_payees as $approval_payee) {
                        $employeeId = $approval_payee->employee_id;
                        $companyId = $approval_payee->company_id;
                        /** @var PayeeVoucher $payee */
                        foreach ($paymentVoucher->payee_vouchers as $payee) {
                            //todo chcek for empid and comany id
                            if (($payee->employee_id === $approval_payee->employee_id) || ($payee->company_id === $approval_payee->company_id)) {
                                PaymentApprovalPayee::where('id', $approval_payee->id)->update([
                                    'remaining_amount' => $approval_payee->remaining_amount + $payee->net_amount
                                ]);
                                $paymentApproval->status = AppConstant::PAYMENT_APPROVAL_READY_FOR_PV;
                                $paymentApproval->save();
                                PayeeVoucher::where('employee_id', $employeeId)
                                    ->where('company_id', $companyId)
                                    ->where('payment_voucher_id', $payee->payment_voucher_id)
                                    ->delete();
                            }
                        }
                        $remAmount = $remAmount + $approval_payee->remaining_amount;
                        $amount = $amount + $approval_payee->net_amount;
                    }
                    if ($remAmount === $amount) {
                        PaymentApproval::where('id', $paymentApproval->id)->update([
                            'status' => AppConstant::PAYMENT_APPROVAL_APPROVED_AND_READY
                        ]);
                    } else {
                        PaymentApproval::where('id', $paymentApproval->id)->update([
                            'status' => AppConstant::PAYMENT_APPROVAL_READY_FOR_PV
                        ]);
                    }
                    DB::commit();
                    return parent::delete($data);
                }
            }

            DB::commit();
            return parent::delete($data); // TODO: Change the autogenerated stub
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public
    function getAll($params = [], $query = null)
    {
        $query = PaymentVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'aie',
            'currency',
            'voucher_source_unit',
            'total_amount',
            'total_tax',
            'payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payee_vouchers.employee.employee_bank.branches.hr_bank',
            'schedule_economic.economic_segment',
            'paying_officer',
            'checking_officer',
            'financial_controller',
            'payment_approval'
        ]);

        if (isset($params['inputs']['is_personal_advance_unit'])) {
            if ($params['inputs']['is_personal_advance_unit'] == "true") {
                $query->whereHas('voucher_source_unit', function ($query) use ($params) {
                    $query->where('is_personal_advance_unit', true);
                });
            }
            if ($params['inputs']['is_personal_advance_unit'] == "false") {
                $query->whereHas('voucher_source_unit', function ($query) use ($params) {
                    $query->where('is_personal_advance_unit', false)
                        ->whereNull('mandate_id');

                });
            }
        }

        if (isset($params['inputs']['search'])) {
            $query->where(function ($d) use ($params) {
                $d->where('deptal_id', 'like', "%" . $params['inputs']['search'] . "%")
                    ->orWhere('payment_description', 'like', "%" . $params['inputs']['search'] . "%");
            });
        }

        if (isset($params['inputs']['available'])) {
            $query->whereHas('voucher_source_unit', function ($query) use ($params) {
                $query->whereNull('mandate_id');
            });
        }

        if (isset($params['inputs']['voucher_source_unit_id'])) {
            $query->where('voucher_source_unit_id', $params['inputs']['voucher_source_unit_id']);
        }

        if (isset($params['inputs']['status'])) {
            $query->where('status', $params['inputs']['status']);
        }
        /* $query->with(['total_tax' => function ($tax) {
             $tax->selectRaw('SUM(total_tax)');
         }]);*/
        return parent::getAll($params, $query);
    }


    public
    function updateStatus($data)
    {

        $pv = PaymentVoucher::whereIn('id', $data['data']['payment_voucher_ids']);

        foreach ($data['data']['payment_voucher_ids'] as $payment_voucher_id) {

            $pv = PaymentVoucher::where('id', $payment_voucher_id)->first();
            $payeeVoucherIds = PayeeVoucher::where('payment_voucher_id', $pv->id)->pluck('id')->all();

            if (is_null($payeeVoucherIds)) {
                throw new AppException('Payee not added');
            }

            $scheduleVoucher = ScheduleEconomic::whereIn('payee_voucher_id', $payeeVoucherIds)->first();

            if (is_null($scheduleVoucher)) {
                throw new AppException('Schedule Economic not added');
            }
        }
        $pv->update([
            'status' => $data['data']['status']
        ]);
        return [
            'data' => 'Status Updated Successfully'
        ];
    }

    public
    function typePaymentVoucher($params)
    {
        /** @var VoucherSourceUnit $vsu */
        $vsu = VoucherSourceUnit::where('id', $params['inputs']['id'])->first();

        if (is_null($vsu)) {
            throw new AppException('voucher source unit not exist');
        } else {
            if ($vsu->is_personal_advance_unit == true) {
                return [
                    'type' => [
                        [
                            'name' => 'PERSONAL ADVANCES VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER
                        ],
                        [
                            'name' => 'NON PERSONAL VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER
                        ],
                        [
                            'name' => 'SPECIAL IMPREST VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER
                        ],
                        [
                            'name' => 'STANDING IMPREST VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_STANDING_VOUCHER
                        ]
                    ]
                ];
            } elseif ($vsu->is_personal_advance_unit == false) {

                return [
                    'type' => [

                        [
                            'name' => 'TRANSFER CASHBOOK VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_TRANSFER_CASHBOOK_VOUCHER
                        ],
                        [
                            'name' => 'DEPOSIT VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_DEPOSIT_VOUCHER
                        ],
                        [
                            'name' => 'REMITTANCE VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_REMITTANCE_VOUCHER
                        ],
                        [
                            'name' => 'EXPENDITURE VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_EXPENDITURE_VOUCHER
                        ], [
                            'name' => 'CREDIT VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_EXPENDITURE_CREDIT_VOUCHER
                        ]
                    ]
                ];
            }
        }

    }

    public
    function statusPaymentVoucher()
    {
        $status = DB::table('treasury_status_payment_voucher')->get();
        return [
            'status' => $status
        ];
    }


    public
    function storePvAdvances($data)
    {

        $paymentV = PaymentVoucher::latest()->orderby('id', 'desc')->first();

        /** @var VoucherSourceUnit $sourceUnit */
        $sourceUnit = VoucherSourceUnit::find($data['data']['voucher_source_unit_id']);

        if (is_null($sourceUnit)) {
            throw new AppException('Voucher Source Unit not exit');
        }
        if ($sourceUnit->is_personal_advance_unit == false) {
            throw new AppException('Cannot Pv of Non Advances');
        }

        if (is_null($paymentV)) {
            $data['data']['deptal_id'] = 1;
        } else {
            $data['data']['deptal_id'] = $paymentV->deptal_id + 1;
        }

        /** @var Cashbook $cashbook */
        $cashbook = Cashbook::find($data['data']['cashbook_id']);
        $data['data']['status'] = 'NEW';
        $data['data']['is_previous_year_advance'] = true;
        $data['data']['currency_id'] = $cashbook->currency_id;

        $aie = Aie::first();
        //dont have any so assigning randomly
        $data['data']['aie_id'] = $aie->id;

        $paymentVoucher = parent::create($data);

        $paymentApproval = PaymentApproval::create([
            'admin_segment_id' => $paymentVoucher->admin_segment_id,
            'fund_segment_id' => $paymentVoucher->fund_segment_id,
            'economic_segment_id' => $paymentVoucher->economic_segment_id,
            'employee_customer' => $paymentVoucher->payee,
            'prepared_by_id' => $paymentVoucher->checking_officer_id,
            'authorised_by_id' => $paymentVoucher->checking_officer_id,
            'currency_id' => $paymentVoucher->currency_id,
            'value_date' => $paymentVoucher->value_date,
            'authorised_date' => Carbon::now()->toDateTimeString(),
            'remark' => $paymentVoucher->payment_description,
            'status' => AppConstant::PAYMENT_APPROVAL_FULLY_USED
        ]);


        $pv = PaymentVoucher::where('id', $paymentVoucher->id)->update([
            'payment_approve_id' => $paymentApproval->id
        ]);

        return $paymentVoucher;
    }


    public
    function getPvAdvances($params)
    {

        $query = PaymentVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'aie',
            'currency',
            'voucher_source_unit',
            'total_amount',
            'total_tax',
            'payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payee_vouchers.employee.employee_bank.branches.hr_bank',
            'schedule_economic.economic_segment',
            'paying_officer',
            'checking_officer',
            'financial_controller'
        ]);

        $query->where('is_previous_year_advance', true);

        if (isset($params['inputs']['voucher_source_unit_id'])) {
            $query->where('voucher_source_unit_id', $params['inputs']['voucher_source_unit_id']);
        }

        if (isset($params['inputs']['status'])) {
            $query->where('status', $params['inputs']['status']);
        }
        /* $query->with(['total_tax' => function ($tax) {
             $tax->selectRaw('SUM(total_tax)');
         }]);*/
        return parent::getAll($params, $query);
    }


    public
    function statusUpdatePreviousYearAdvance($data)
    {
        $pv = PaymentVoucher::whereIn('id', json_decode($data['data']['payment_voucher_ids'], true));

        foreach (json_decode($data['data']['payment_voucher_ids'], true) as $payment_voucher_id) {

            $pv = PaymentVoucher::with('total_amount')->where('id', $payment_voucher_id)->first();
//dd($pv);
            $payeeVoucherIds = PayeeVoucher::where('payment_voucher_id', $pv->id)->pluck('id')->all();

            if (is_null($payeeVoucherIds)) {
                throw new AppException('Payee not added');
            }

//            $scheduleVoucher = ScheduleEconomic::whereIn('payee_voucher_id', $payeeVoucherIds)->first();
//
//            if (is_null($scheduleVoucher)) {
//                throw new AppException('Schedule Economic not added');
//            }

            $retireVoucher = RetireVoucher::create([
                'payment_voucher_id' => $pv->id,
                'status' => AppConstant::RETIRE_VOUCHER_NEW
            ]);

            $retireLiability = RetireLiability::create([
                'liability_value_date' => $pv->value_date,
                'amount' => $pv->total_amount->amount,
                'economic_segment_id' => $pv->economic_segment_id,
                'retire_voucher_id' => $retireVoucher->id,
                'details' => $pv->payment_description,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        }


        $pv->update([
            'status' => AppConstant::VOUCHER_STATUS_CLOSED
        ]);
        return [
            'data' => 'Status Updated Successfully'
        ];
    }


    public function deletePreviousYearAdvance($data)
    {
        $paymentVoucher = PaymentVoucher::find($data['data']['id']);
        if ($paymentVoucher->status != AppConstant::VOUCHER_STATUS_NEW) {
            throw new AppException('Cannot delete status is not NEW');
        }
        $data['id'] = $data['data']['id'];

        PayeeVoucher::where('payment_voucher_id', $data['data']['id'])->delete();

        return parent::delete($data);
    }

    public function updatePreviousYearAdvance($data)
    {
        $paymentVoucher = PaymentVoucher::find($data['data']['id']);
        if ($paymentVoucher->status != AppConstant::VOUCHER_STATUS_NEW) {
            throw new AppException('Cannot Update status is not NEW');
        }
        $data['id'] = $data['data']['id'];
        return parent::update($data);
    }


    public function downloadPaymentTaxReport($data)
    {

        $fileName = 'payment-voucher-tax' . \Carbon\Carbon::now()->toDateTimeString() . '.pdf';
        $filePath = "pdf/";

        $paymentV = PaymentVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'aie',
            'currency',
            'voucher_source_unit',
            'total_amount',
            'total_tax',
            'payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payee_vouchers.employee.employee_bank.branches.hr_bank',
            'schedule_economic.economic_segment',
            'paying_officer',
            'checking_officer',
            'financial_controller'
        ])->find($data['data']['id']);
        $companyInformation = CompanyInformation::find(1);

        $payees = " ";
        $address = " ";
        $count = -1;
        /** @var PayeeVoucher $payee_voucher */
        foreach ($paymentV->payee_vouchers as $payee_voucher) {
            if ($payee_voucher->employee_id) {
                $payees = $payee_voucher->employee->first_name . ' ';
                $address = $payee_voucher->employee->employee_contact_details->country->name;
            } else {
                $payees = $payee_voucher->admin_company->name . ' ';
                $address = $payee_voucher->admin_company->country;
            }
            $count += 1;
        }
        $paymentV->default_setting = DefaultSetting::with(['checking_officer',
            'financial_controller',
            'paying_officer',
            'account_head',
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'sub_organisation'])->find(1);
        $finalPayeesText = $count > 0 ? $payees . '+' . $count : $payees;
        $paymentV->final_payees_text = $finalPayeesText;
        $paymentV->address = $address;
        $paymentV->deptalKey = $companyInformation->short_code . '/' . $paymentV->voucher_source_unit->short_name . '/' . $paymentV->deptal_id . '/' . Carbon::parse($paymentV->value_date)->year;
        app()->make(WKHTMLPDfConverter::class)
            ->convert(view('reports.payment-voucher-tax-report', ['data' => $paymentV])->render(), $fileName);

        return ['url' => url($filePath . $fileName)];
    }

    public function downloadPaymentReport($params)
    {
        $fileName = 'payment-voucher' . \Carbon\Carbon::now()->toDateTimeString() . '.pdf';
        $filePath = "pdf/";

        /** @var PaymentVoucher $paymentV */
        $paymentV = PaymentVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'aie',
            'currency',
            'voucher_source_unit',
            'total_amount',
            'total_tax',
            'payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payee_vouchers.employee.employee_bank.branches.hr_bank',
            'schedule_economic.economic_segment',
            'paying_officer',
            'checking_officer',
            'financial_controller'
        ])->find($params['inputs']['id']);

        $companyInformation = CompanyInformation::find(1);
        $payees = " ";
        $address = " ";
        $count = -1;
        /** @var PayeeVoucher $payee_voucher */
        foreach ($paymentV->payee_vouchers as $payee_voucher) {
            if ($payee_voucher->employee_id) {
                $payees = $payee_voucher->employee->first_name . ' ';
                $address = $payee_voucher->employee->employee_contact_details->country->name;
            } else {
                $payees = $payee_voucher->admin_company->name . ' ';
                $address = $payee_voucher->admin_company->country;
            }
            $count += 1;
        }
        $paymentV->default_setting = DefaultSetting::with(['checking_officer',
            'financial_controller',
            'paying_officer',
            'account_head',
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'sub_organisation'])->find(1);
        $finalPayeesText = $count > 0 ? $payees . '+' . $count : $payees;
        $paymentV->final_payees_text = $finalPayeesText;
        $paymentV->address = $address;
        $paymentV->deptalKey = $companyInformation->short_code . '/' . $paymentV->voucher_source_unit->short_name . '/' . $paymentV->deptal_id . '/' . Carbon::parse($paymentV->value_date)->year;

        $esCombineCodes = str_split(str_replace('-', '', $paymentV->admin_segment->combined_code));
        if (count($esCombineCodes) < 12) {
            $esTds = 12 - count($esCombineCodes);
            while ($esTds > 0) {
                $esCombineCodes[] = '';
                $esTds--;
            }
        }
        $paymentV['es_code'] = $esCombineCodes;

        $eCombineCodes = str_split(str_replace('-','',$paymentV->economic_segment->combined_code));
        if (count($eCombineCodes) < 8) {
            $esTds = 8 - count($eCombineCodes);
            while ($esTds > 0) {
                $eCombineCodes[] = '';
                $esTds--;
            }
        }
        $paymentV['e_code'] = $eCombineCodes;

        $fCombineCode = str_split(str_replace('-', '', $paymentV->functional_segment->combined_code));
        if (count($fCombineCode) < 5) {
            $esTds = 5 - count($fCombineCode);
            while ($esTds > 0) {
                $fCombineCode[] = '';
                $esTds--;
            }
        }
        $paymentV['f_code'] = $fCombineCode;

        $psCombineCode = str_split(str_replace('-', '', $paymentV->program_segment->combined_code));
        if (count($psCombineCode) < 14) {
            $esTds = 14 - count($psCombineCode);
            while ($esTds > 0) {
                $psCombineCode[] = '';
                $esTds--;
            }
        }
        $paymentV['ps_code'] = $psCombineCode;

        $fsCombineCode = str_split(str_replace('-', '', $paymentV->fund_segment->combined_code));
        if (count($fsCombineCode) < 5) {
            $esTds = 5 - count($fsCombineCode);
            while ($esTds > 0) {
                $fsCombineCode[] = '';
                $esTds--;
            }
        }
        $paymentV['fs_code'] = $fsCombineCode;

        $gCombineCode = str_split(str_replace('-', '', $paymentV->geo_code_segment->combined_code));
        if (count($gCombineCode) < 8) {
            $esTds = 8 - count($gCombineCode);
            while ($esTds > 0) {
                $gCombineCode[] = '';
                $esTds--;
            }
        }
        $paymentV['g_code'] = $gCombineCode;

        $paymentV['date'] = str_split(Carbon::parse($paymentV->value_date)->format('d'));
        $paymentV['date'] = array_merge($paymentV['date'], str_split(Carbon::parse($paymentV->value_date)->format('m')));
        $paymentV['date'] = array_merge($paymentV['date'], str_split(Carbon::parse($paymentV->value_date)->format('y')));

        if (isset($params['inputs']['bs'])) {
            app()->make(WKHTMLPDfConverter::class)
                ->convertBrowserShot(view('reports.payment-voucher-report', ['data' => $paymentV])->render(), $fileName);
        } else {
            app()->make(WKHTMLPDfConverter::class)
                ->convert(view('reports.payment-voucher-report', ['data' => $paymentV])->render(), $fileName);
        }


        return ['url' => url($filePath . $fileName)];
    }

}
