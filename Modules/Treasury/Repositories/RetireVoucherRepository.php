<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanySetting;
use Modules\Finance\Models\Currency;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;
use Modules\Finance\Repositories\JournalVoucherRepository;
use Modules\Treasury\Models\Cashbook;
use Modules\Treasury\Models\Mandate;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ReceiptPayee;
use Modules\Treasury\Models\ReceiptScheduleEconomic;
use Modules\Treasury\Models\ReceiptVoucher;
use Modules\Treasury\Models\RetireLiability;
use Modules\Treasury\Models\RetireVoucher;

class RetireVoucherRepository extends EloquentBaseRepository
{
    public $model = RetireVoucher::class;

    public function getAll($params = [], $query = null)
    {
        $this->model = PaymentVoucher::class;

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
            'retire_voucher.retire_liabilities.economic_segment',
            'retire_voucher.retire_liabilities.company',
            'retire_voucher.retire_liabilities.employee'
        ])->whereIn('type', [
            AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER,
            AppConstant::VOUCHER_TYPE_STANDING_VOUCHER,
            AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER,
            AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER
        ]);


        if (isset($params['inputs']['retire_status'])) {

            if ($params['inputs']['retire_status'] == AppConstant::RETIRE_VOUCHER_NEW) {
                $query->whereHas('retire_voucher', function ($query) use ($params) {
                    $query->where('status', AppConstant::RETIRE_VOUCHER_NEW);
                })->orDoesntHave('retire_voucher');
            } else {
                $query->whereHas('retire_voucher', function ($query) use ($params) {
                    $query->where('status', $params['inputs']['retire_status']);
                });
            }
        }
        if (isset($params['inputs']['voucher_source_unit_id'])) {
            $query->where('voucher_source_unit_id', $params['inputs']['voucher_source_unit_id']);
        }

        if (isset($params['inputs']['search'])) {
            $query->where('deptal_id', $params['inputs']['search'])
                ->orWhereYear('value_date', $params['inputs']['search']);
        }


        return parent::getAll($params, $query);
    }


    public function getLiabilities($params)
    {
        $retireVouchers = RetireVoucher::with([
            'payment_voucher',
            'retire_liabilities.economic_segment',
            'retire_liabilities.company',
            'retire_liabilities.employee'
        ])->where('payment_voucher_id', $params['inputs']['retire_voucher_id'])->get();

        return $retireVouchers;
    }


    public function create($data)
    {

        DB::beginTransaction();
        try {

            $retireV = RetireVoucher::where('payment_voucher_id', $data['data']['payment_voucher_id'])->first();

            /** @var PaymentVoucher $pv */
            $pv = PaymentVoucher::with('total_amount')->find($data['data']['payment_voucher_id']);
            if (is_null($pv)) {
                throw new AppException('Payment Voucher either deleted or not Exist');
            }
            if (is_null($pv->total_amount)) {
                throw new AppException('Payee not added for payment voucher Id ' . $pv->id);
            }
            if (is_null($retireV)) {
                $retireV = RetireVoucher::create([
                    'payment_voucher_id' => $data['data']['payment_voucher_id'],
                    'status' => AppConstant::RETIRE_VOUCHER_NEW
                ]);
            }
            RetireLiability::where('retire_voucher_id', $retireV->id)->delete();
            $totalAmount = 0;
            $economicSegment = null;
            foreach ($data['data']['liabilities'] as $key => $liability) {
                $d['retire_voucher_id'] = $retireV->id;
                $d['liability_value_date'] = $liability['liability_value_date'];
                $d['amount'] = $liability['amount'];
                $d['company_id'] = $liability['company_id'];
                $d['employee_id'] = $liability['employee_id'];
                $d['economic_segment_id'] = $liability['economic_segment_id'];
                $d['details'] = $liability['details'];
                $d['created_at'] = Carbon::now()->toDateTimeString();
                $d['updated_at'] = Carbon::now()->toDateTimeString();
                $economicSegment[] = $liability['economic_segment_id'];
                $totalAmount = $totalAmount + $liability['amount'];
                unset($data);
                $liabilities[] = $d;
            }

            if ($totalAmount > (float)$pv->total_amount->amount) {
                throw new AppException('liability amount should be equal or less than gross amount');
            }

            if (count($economicSegment) > 0) {
                $cashbook = Cashbook::whereIn('economic_segment_id', $economicSegment)->pluck('economic_segment_id')->all();
                $cashbook = array_unique($cashbook);
                if (count($cashbook) !== 1 && count($cashbook) !== 0) {
                    throw new AppException('Economic segments selected , Associated to more than one cashbook');
                }
            }

            if (count($liabilities) > 0) {
                RetireLiability::insert($liabilities);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return RetireVoucher::with('retire_liabilities')->find($retireV->id);
    }


    public function updateStatus($data)
    {

        $data['data']['payment_voucher_ids'] = json_decode($data['data']['payment_voucher_ids'], true);
        $retireV = RetireVoucher::whereIn('payment_voucher_id', $data['data']['payment_voucher_ids']);

        DB::beginTransaction();
        try {
            $paymentVouchers = PaymentVoucher::with([
                'voucher_source_unit',
                'payee_vouchers.schedule_economics'
            ])->whereIn('id', $data['data']['payment_voucher_ids'])->get();
            Log::info($data['data']['payment_voucher_ids']);
            /** @var CompanySetting $companySetting */
            $companySetting = CompanySetting::find(1);
            /** @var PaymentVoucher $paymentVoucher */
            foreach ($paymentVouchers as $paymentVoucher) {
                ///if not personal advance voucehr we are getting
                $pv = PaymentVoucher::where('id', $paymentVoucher->id)->whereHas('voucher_source_unit', function ($query) {
                    $query->where('is_personal_advance_unit', false);
                })->first();

                Log::info("pv start");
                Log::info($pv);
                if ($pv) {
                    throw new AppException('Only advances type voucher can be retired');
                }
                /** @var RetireVoucher $retireVoucher */
                $retireVoucher = RetireVoucher::with('retire_liabilities')->where('payment_voucher_id', $paymentVoucher->id)->first();

                if (is_null($retireVoucher)) {
                    throw new AppException('Liability to be added in retire voucher');
                }
                if (is_null($retireVoucher->retire_liabilities)) {
                    throw new AppException('Liability to be added in retire voucher');
                }
                if ($retireVoucher->retire_liabilities->isEmpty()) {
                    throw new AppException('Liability to be added in retire voucher');
                }
                if (!($paymentVoucher->status === AppConstant::VOUCHER_STATUS_CLOSED || $paymentVoucher->status === AppConstant::VOUCHER_STATUS_POSTED_TO_GL)) {
                    throw new AppException('Payment Voucher Id ' . $paymentVoucher->id . ' not CLOSED or POSTED TO GL  yet');
                }

                if ($paymentVoucher->type === AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER || $paymentVoucher->type === AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER) {
                    $type = AppConstant::VOUCHER_TYPE_NON_PERSONAL_ADVANCES_RECEIVED_VOUCHER;
                } elseif ($paymentVoucher->type === AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER) {
                    $type = AppConstant::VOUCHER_TYPE_SPECIAL_IMPREST_RECEIVED_VOUCHER;
                } else {
                    $type = AppConstant::VOUCHER_TYPE_STANDING_IMPREST_RECEIVED_VOUCHER;
                }

                /** @var Mandate $mandate */
                $mandate = Mandate::find($paymentVoucher->mandate_id);
                $currency = Currency::find($paymentVoucher->currency_id);
                if ($data['data']['retire_status'] == AppConstant::RETIRE_VOUCHER_RETIRE) {
                    $retireLiabilitySum = RetireLiability::where('retire_voucher_id', $retireVoucher->id)->sum('amount');
                    if ($retireLiabilitySum != $paymentVoucher->total_amount->amount) {
                        throw new AppException('Retire Liability and Payment voucher should have equal amount');
                    }

                } elseif ($data['data']['retire_status'] == AppConstant::RETIRE_VOUCHER_RETIRE_POSTED_TO_GL) {
                    Log::info("post to gl");
                    //todo create rv and payee
                    /** @var ReceiptVoucher $rv */
                    $rv = ReceiptVoucher::create([
                        'voucher_source_unit_id' => $paymentVoucher->voucher_source_unit_id,
                        'source_department' => $paymentVoucher->source_unit,
                        'deptal_id' => $paymentVoucher->deptal_id,
                        'voucher_number' => $paymentVoucher->voucher_number,
                        'value_date' => $paymentVoucher->value_date,
                        'receipt_number' => null,
                        'payee' => $paymentVoucher->payee,
                        'type' => $type,
                        'status' => $paymentVoucher->status,
                        'payment_description' => $paymentVoucher->payment_description,
                        'x_rate' => $paymentVoucher->x_rate,
                        'official_x_rate' => $paymentVoucher->official_x_rate,
                        'admin_segment_id' => $paymentVoucher->admin_segment_id,
                        'fund_segment_id' => $paymentVoucher->fund_segment_id,
                        'economic_segment_id' => $paymentVoucher->economic_segment_id,
                        'program_segment_id' => $paymentVoucher->program_segment_id,
                        'functional_segment_id' => $paymentVoucher->fund_segment_id,
                        'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
                        'receiving_officer_id' => $paymentVoucher->checking_officer_id,
                        'prepared_by_officer_id' => $paymentVoucher->checking_officer_id,
                        'closed_by_officer_id' => $paymentVoucher->checking_officer_id,
                        'cashbook_id' => $mandate->cashbook_id
                    ]);

                    $payees = null;
                    /** @var PayeeVoucher $payee_voucher */
                    foreach ($paymentVoucher->payee_vouchers as $payee_voucher) {
                        $rvPayee = ReceiptPayee::create([
                            'receipt_voucher_id' => $rv->id,
                            'employee_id' => $payee_voucher->employee_id,
                            'company_id' => $payee_voucher->company_id,
                            'total_amount' => $payee_voucher->net_amount,
                            'year' => $payee_voucher->year,
                            'line_detail' => $payee_voucher->details ?? '',
                            'pay_mode' => AppConstant::RECEIPT_PAY_MODE_CASH,
                            'instrument_number' => '',
                            'instrument_type' => '',
                            'instrument_teller_number' => '',
                            'instrument_issued_by' => '',
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);
                        //create schedule economic for rv

                        $receiptScheduleEconomic = null;
                        foreach ($payee_voucher->schedule_economics as $schedule_economic) {
                            $temp = [
                                'receipt_payee_id' => $rvPayee->id,
                                'receipt_voucher_id' => $rv->id,
                                'economic_segment_id' => $schedule_economic->economic_segment_id,
                                'amount' => $schedule_economic->amount
                            ];
                            $receiptScheduleEconomic[] = $temp;
                        }
                        ReceiptScheduleEconomic::insert($receiptScheduleEconomic);
                    }


                    //todo create jv and detais
                    $jv = JournalVoucher::create([
                        'source_app' => 'E-Voucher (Treasury)',
                        'batch_number' => 1,
                        'jv_value_date' => $rv->value_date,
                        'fund_segment_id' => $rv->fund_segment_id,
                        'jv_reference' => $rv->source_department,
                        'status' => AppConstant::JV_STATUS_NEW,
                        'transaction_details' => $rv->payment_description,
                        'prepared_value_date' => Carbon::now()->toDateTimeString(),
                        'prepared_transaction_date' => Carbon::now()->toDateTimeString(),
                        'checked_value_date' => null,
                        'checked_transaction_date' => null,
                        'posted_value_date' => null,
                        'posted_transaction_date' => null,
                        'prepared_user_id' => null,
                        'checked_user_id' => null,
                        'posted_user_id' => null
                    ]);

                    $jvDetail = null;
                    //credit entry for jv
                    $jvDetail = JournalVoucherDetail::create([
                        'journal_voucher_id' => $jv->id,
                        'currency' => $currency->code_currency,
                        'x_rate_local' => $paymentVoucher->x_rate,
                        'bank_x_rate_to_usd' => $paymentVoucher->official_x_rate,
                        'account_name' => $paymentVoucher->payment_description,
                        'line_reference' => $paymentVoucher->deptal_id,
                        'line_value' => $paymentVoucher->total_amount->amount,
                        'admin_segment_id' => $rv->admin_segment_id,
                        'fund_segment_id' => $rv->fund_segment_id,
                        'economic_segment_id' => $rv->economic_segment_id,
                        'programme_segment_id' => $rv->program_segment_id,
                        'functional_segment_id' => $rv->functional_segment_id,
                        'geo_code_segment_id' => $rv->geo_code_segment_id,
                        'line_value_type' => 'DEBIT',
                        'lv_line_value' => $paymentVoucher->total_amount->amount,
                        'local_currency' => $companySetting->local_currency
                    ]);

                    //debit entry for jv

                    $jvDetails = null;
                    $retireAmount = 0;
                    /** @var RetireLiability $retire_liability */


                    //retirement Payment Voucher RV
//                    $rv2 = ReceiptVoucher::create([
//                        'voucher_source_unit_id' => $paymentVoucher->voucher_source_unit_id,
//                        'source_department' => $paymentVoucher->source_unit,
//                        'deptal_id' => $paymentVoucher->deptal_id,
//                        'voucher_number' => $paymentVoucher->voucher_number,
//                        'value_date' => $paymentVoucher->value_date,
//                        'receipt_number' => null,
//                        'payee' => $paymentVoucher->payee,
//                        'type' => $type,
//                        'status' => $paymentVoucher->status,
//                        'payment_description' => $paymentVoucher->payment_description,
//                        'x_rate' => $paymentVoucher->x_rate,
//                        'official_x_rate' => $paymentVoucher->official_x_rate,
//                        'admin_segment_id' => $paymentVoucher->admin_segment_id,
//                        'fund_segment_id' => $paymentVoucher->fund_segment_id,
//                        'economic_segment_id' => $paymentVoucher->economic_segment_id,
//                        'program_segment_id' => $paymentVoucher->program_segment_id,
//                        'functional_segment_id' => $paymentVoucher->fund_segment_id,
//                        'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
//                        'receiving_officer_id' => $paymentVoucher->checking_officer_id,
//                        'prepared_by_officer_id' => $paymentVoucher->checking_officer_id,
//                        'closed_by_officer_id' => $paymentVoucher->checking_officer_id,
//                        'cashbook_id' => $mandate->cashbook_id
//                    ]);


                    foreach ($retireVoucher->retire_liabilities as $retire_liability) {
//                        $rvPayee2 = ReceiptPayee::create([
//                            'receipt_voucher_id' => $rv2->id,
//                            'employee_id' => $retire_liability->employee_id,
//                            'company_id' => $retire_liability->company_id,
//                            'total_amount' => $retire_liability->amount,
//                            'year' => Carbon::now()->year,
//                            'line_detail' => $retire_liability->details ?? '',
//                            'pay_mode' => AppConstant::RECEIPT_PAY_MODE_CASH,
//                            'instrument_number' => '',
//                            'instrument_type' => '',
//                            'instrument_teller_number' => '',
//                            'instrument_issued_by' => '',
//                            'created_at' => Carbon::now()->toDateTimeString(),
//                            'updated_at' => Carbon::now()->toDateTimeString()
//                        ]);
//
//                        $scheduleEconomic2 = ReceiptScheduleEconomic::create([
//                            'receipt_payee_id' => $rvPayee2->id,
//                            'receipt_voucher_id' => $rv2->id,
//                            'economic_segment_id' => $retire_liability->economic_segment_id,
//                            'amount' => $retire_liability->amount
//                        ]);


                        //refund entry in Jv
                        $cashbook = Cashbook::where('economic_segment_id', $retire_liability->economic_segment_id)->first();


//                        $rv = ReceiptVoucher::create([
//                            'voucher_source_unit_id' => $paymentVoucher->voucher_source_unit_id,
//                            'source_department' => $paymentVoucher->source_unit,
//                            'deptal_id' => $paymentVoucher->deptal_id,
//                            'voucher_number' => $paymentVoucher->voucher_number,
//                            'value_date' => $paymentVoucher->value_date,
//                            'receipt_number' => null,
//                            'payee' => $paymentVoucher->payee,
//                            'type' => $type,
//                            'status' => $paymentVoucher->status,
//                            'payment_description' => $paymentVoucher->payment_description,
//                            'x_rate' => $paymentVoucher->x_rate,
//                            'official_x_rate' => $paymentVoucher->official_x_rate,
//                            'admin_segment_id' => $paymentVoucher->admin_segment_id,
//                            'fund_segment_id' => $paymentVoucher->fund_segment_id,
//                            'economic_segment_id' => $paymentVoucher->economic_segment_id,
//                            'program_segment_id' => $paymentVoucher->program_segment_id,
//                            'functional_segment_id' => $paymentVoucher->fund_segment_id,
//                            'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
//                            'receiving_officer_id' => $paymentVoucher->checking_officer_id,
//                            'prepared_by_officer_id' => $paymentVoucher->checking_officer_id,
//                            'closed_by_officer_id' => $paymentVoucher->checking_officer_id,
//                            'cashbook_id' => $mandate->cashbook_id
//                        ]);
//
//
//
//                        $payees = null;
//                        /** @var PayeeVoucher $payee_voucher */
//                        foreach ($paymentVoucher->payee_vouchers as $payee_voucher) {
//                            $rvPayee = ReceiptPayee::create([
//                                'receipt_voucher_id' => $rv->id,
//                                'employee_id' => $payee_voucher->employee_id,
//                                'company_id' => $payee_voucher->company_id,
//                                'total_amount' => $payee_voucher->net_amount,
//                                'year' => $payee_voucher->year,
//                                'line_detail' => $payee_voucher->details ?? '',
//                                'pay_mode' => AppConstant::RECEIPT_PAY_MODE_CASH,
//                                'instrument_number' => '',
//                                'instrument_type' => '',
//                                'instrument_teller_number' => '',
//                                'instrument_issued_by' => '',
//                                'created_at' => Carbon::now()->toDateTimeString(),
//                                'updated_at' => Carbon::now()->toDateTimeString()
//                            ]);
//                            //create schedule economic for rv
//
//                            $receiptScheduleEconomic = null;
//                            foreach ($payee_voucher->schedule_economics as $schedule_economic) {
//                                $temp = [
//                                    'receipt_payee_id' => $rvPayee->id,
//                                    'receipt_voucher_id' => $rv->id,
//                                    'economic_segment_id' => $schedule_economic->economic_segment_id,
//                                    'amount' => $schedule_economic->amount
//                                ];
//                                $receiptScheduleEconomic[] = $temp;
//                            }
//                            ReceiptScheduleEconomic::insert($receiptScheduleEconomic);
//                        }


                        if ($cashbook) {
                            $jvDetail = JournalVoucherDetail::create([
                                'journal_voucher_id' => $jv->id,
                                'currency' => $currency->code_currency,
                                'x_rate_local' => $paymentVoucher->x_rate,
                                'bank_x_rate_to_usd' => $paymentVoucher->official_x_rate,
                                'account_name' => 'Refund',
                                'line_reference' => $paymentVoucher->deptal_id,
                                'line_value' => $retire_liability->amount,
                                'admin_segment_id' => $rv->admin_segment_id,
                                'fund_segment_id' => $rv->fund_segment_id,
                                'economic_segment_id' => $cashbook->economic_segment_id,
                                'programme_segment_id' => $rv->program_segment_id,
                                'functional_segment_id' => $rv->functional_segment_id,
                                'geo_code_segment_id' => $rv->geo_code_segment_id,
                                'line_value_type' => 'CREDIT',
                                'lv_line_value' => $retire_liability->amount,
                                'local_currency' => $companySetting->local_currency
                            ]);
                        } else {
                            $temp = [
                                'journal_voucher_id' => $jv->id,
                                'currency' => $currency->code_currency,
                                'x_rate_local' => $paymentVoucher->x_rate,
                                'bank_x_rate_to_usd' => $paymentVoucher->official_x_rate,
                                'account_name' => $retire_liability->details,
                                'line_reference' => $paymentVoucher->deptal_id,
                                'line_value' => $retire_liability->amount,
                                'admin_segment_id' => $paymentVoucher->admin_segment_id,
                                'fund_segment_id' => $paymentVoucher->fund_segment_id,
                                'economic_segment_id' => $retire_liability->economic_segment_id,
                                'programme_segment_id' => $paymentVoucher->program_segment_id,
                                'functional_segment_id' => $paymentVoucher->functional_segment_id,
                                'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
                                'line_value_type' => 'CREDIT',
                                'lv_line_value' => $retire_liability->amount,
                                'local_currency' => $companySetting->local_currency,
                                'created_at' => Carbon::now()->toDateTimeString(),
                                'updated_at' => Carbon::now()->toDateTimeString()
                            ];
                            $retireAmount = $retireAmount + $retire_liability->amount;
                            $jvDetails[] = $temp;
                        }
                    }
                    if (count($jvDetails) > 0)
                        JournalVoucherDetail::insert($jvDetails);

                    //todo check for refund

                    $query = RetireLiability::where('retire_voucher_id', $retireVoucher->id);
                    $liabilityEcoId = $query->pluck('economic_segment_id');

                    $retireLiability = $query->first();
                    $cashbook = Cashbook::whereIn('economic_segment_id', $liabilityEcoId)->first();

                    if ($cashbook) {
                        Log::info("refund rv");
                        /** @var ReceiptVoucher $rv */
                        $rv = ReceiptVoucher::create([
                            'voucher_source_unit_id' => $paymentVoucher->voucher_source_unit_id,
                            'source_department' => $paymentVoucher->source_unit,
                            'deptal_id' => $paymentVoucher->deptal_id,
                            'voucher_number' => $paymentVoucher->voucher_number,
                            'value_date' => $paymentVoucher->value_date,
                            'receipt_number' => null,
                            'payee' => $paymentVoucher->payee,
                            'type' => $type,
                            'status' => $paymentVoucher->status,
                            'payment_description' => $paymentVoucher->payment_description,
                            'x_rate' => $paymentVoucher->x_rate,
                            'official_x_rate' => $paymentVoucher->official_x_rate,
                            'admin_segment_id' => $paymentVoucher->admin_segment_id,
                            'fund_segment_id' => $paymentVoucher->fund_segment_id,
                            'economic_segment_id' => $paymentVoucher->economic_segment_id,
                            'program_segment_id' => $paymentVoucher->program_segment_id,
                            'functional_segment_id' => $paymentVoucher->fund_segment_id,
                            'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
                            'receiving_officer_id' => $paymentVoucher->checking_officer_id,
                            'prepared_by_officer_id' => $paymentVoucher->checking_officer_id,
                            'closed_by_officer_id' => $paymentVoucher->checking_officer_id,
                            'cashbook_id' => $mandate->cashbook_id
                        ]);

                        $rvPayee = ReceiptPayee::create([
                            'receipt_voucher_id' => $rv->id,
                            'employee_id' => $paymentVoucher->payee_vouchers[0]->employee_id,
                            'company_id' => $paymentVoucher->payee_vouchers[0]->company_id,
                            'total_amount' => $retireLiability->amount,
                            'year' => $paymentVoucher->payee_vouchers[0]->year,
                            'line_detail' => 'Refund',
                            'pay_mode' => AppConstant::RECEIPT_PAY_MODE_CASH,
                            'instrument_number' => '',
                            'instrument_type' => '',
                            'instrument_teller_number' => '',
                            'instrument_issued_by' => '',
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);
                        //create schedule economic for rv

                        $receiptScheduleEconomic = ReceiptScheduleEconomic::create([
                            'receipt_payee_id' => $rvPayee->id,
                            'receipt_voucher_id' => $rv->id,
                            'economic_segment_id' => $cashbook->economic_segment_id,
                            'amount' => $paymentVoucher->total_amount->amount - $retireAmount
                        ]);
                    }

                    //insert into trail report
                    $jds = JournalVoucherDetail::where('journal_voucher_id', $jv->id)->get();
                    foreach ($jds as $jd) {
                        $jd = $jd->toArray();
                        $jvRepository = new JournalVoucherRepository();
                        $jvRepository->insertInTrailReport($jd);
                    }

                }
            }

            if ($retireV->get()->isEmpty()) {
                throw new AppException('Cannot find Retire Voucher');
            } else {
                $retireV->update([
                        'status' => $data['data']['retire_status']]
                );
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function statusRetireVoucher()
    {
        $status = DB::table('treasury_status_retire_voucher')->get();
        return [
            'status' => $status
        ];
    }


    public function updateLiabilities($data)
    {
        $data['id'] = $data['data']['id'];

        $retireVoucher = RetireVoucher::find($data['data']['retire_voucher_id']);

        if ($retireVoucher->status != AppConstant::RETIRE_VOUCHER_NEW) {
            throw new AppException('Cannot add liability Retire Voucher Status is not New');
        }
        $this->model = RetireLiability::class;
        return parent::update($data);

    }
}
