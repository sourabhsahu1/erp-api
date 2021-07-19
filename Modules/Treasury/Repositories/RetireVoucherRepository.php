<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use App\Services\WKHTMLPDfConverter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyInformation;
use Modules\Admin\Models\CompanySetting;
use Modules\Finance\Models\Currency;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;
use Modules\Finance\Repositories\JournalVoucherRepository;
use Modules\Treasury\Models\Cashbook;
use Modules\Treasury\Models\DefaultSetting;
use Modules\Treasury\Models\Mandate;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ReceiptPayee;
use Modules\Treasury\Models\ReceiptScheduleEconomic;
use Modules\Treasury\Models\ReceiptVoucher;
use Modules\Treasury\Models\RetireLiability;
use Modules\Treasury\Models\RetireVoucher;
use Modules\Treasury\Models\RetireVoucherLog;

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
        $query = RetireVoucher::query();
        if (isset($params['inputs']['company_id']) || isset($params['inputs']['employee_id'])) {
            $query->whereHas('retire_liabilities', function ($q) use ($params) {
                if (isset($params['inputs']['company_id']) && $params['inputs']['company_id']) {
                    $q->where('company_id', $params['inputs']['company_id']);
                }
                if (isset($params['inputs']['employee_id']) && $params['inputs']['employee_id']) {
                    $q->where('employee_id', $params['inputs']['employee_id']);
                }
            });
        }

        $query->with(['payment_voucher', 'retire_liabilities' => function ($rQuery) use ($params) {
            if (isset($params['inputs']['company_id']) && $params['inputs']['company_id']) {
                $rQuery->where('company_id', $params['inputs']['company_id']);
            }
            if (isset($params['inputs']['employee_id']) && $params['inputs']['employee_id']) {
                $rQuery->where('employee_id', $params['inputs']['employee_id']);
            }
            $rQuery->with(['economic_segment', 'company', 'employee']);
        }])->where('payment_voucher_id', $params['inputs']['payment_voucher_id']);

        return $query->get();
//        return parent::getAll($params, $query);
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

            RetireVoucherLog::create([
                'retire_voucher_id' => $retireV->id,
                'previous_status' => null,
                'current_status' => 'NEW',
                'date' => Carbon::now()->toDateString(),
                'admin_id' => $data['data']['user_id']
            ]);

            $q = RetireLiability::where('retire_voucher_id', $retireV->id);
            $retireSum = $q->sum('amount');

            $retireLiability = $q->get()->toArray();
            $finalArRetireLs = array_merge($retireLiability, $data['data']['liabilities']);
            $economicSegment = null;
            $liabilityPayers = null;
            foreach ($finalArRetireLs as $retireL) {
                if (!is_null($retireL['company_id'])) {
                    $liabilityPayers[$retireL['company_id']][] = $retireL['economic_segment_id'];
                } elseif (!is_null($retireL['employee_id'])) {
                    $liabilityPayers[$retireL['employee_id']][] = $retireL['economic_segment_id'];
                }
            }
//            dd($liabilityPayers);
            $totalAmount = 0;

            foreach ($data['data']['liabilities'] as $key => $liability) {

                $retireLiab = RetireLiability::where('economic_segment_id', $liability['economic_segment_id'])
                    ->where('retire_voucher_id', $retireV->id)
                    ->where('company_id',$liability['company_id'])
                    ->where('employee_id',$liability['employee_id'])
                    ->first();

                if ($retireLiab) {
                    throw new AppException('liability exists of selected payer and economic segment id');
                }

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
//                if (!is_null($liability['company_id'])) {
//                    $liabilityPayers[$liability['company_id']][] = $liability['economic_segment_id'];
//                } elseif (!is_null($liability['employee_id'])) {
//                    $liabilityPayers[$liability['employee_id']][] = $liability['economic_segment_id'];
//                }
            }

            if ($retireSum + $totalAmount > (float)$pv->total_amount->amount) {
                throw new AppException('liability amount should be equal or less than gross amount');
            }

            if (count($liabilityPayers) > 0) {
                foreach ($liabilityPayers as $liabilityPayer) {
                    $cashbook = Cashbook::whereIn('economic_segment_id', $liabilityPayer)->pluck('economic_segment_id')->all();
                    $cashbook = array_unique($cashbook);
                    if (count($cashbook) !== 1 && count($cashbook) !== 0) {
                        throw new AppException('Economic segments selected , Associated to more than one cashbook');
                    }
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
        /** @var CompanySetting $companySetting */
        $companySetting = CompanySetting::find(1);
        if (is_null($companySetting)) {
            throw new AppException("Company setting is null");
        }

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


                    //todo create jv and details
                    $jv = JournalVoucher::create([
                        'source_app' => 'E-Voucher (Treasury)',
                        'batch_number' => 1,
                        'jv_value_date' => $rv->value_date,
                        'fund_segment_id' => $rv->fund_segment_id,
                        'jv_reference' => $rv->source_department,
                        'status' => $companySetting->default_status,
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

                    foreach ($retireVoucher->retire_liabilities as $retire_liability) {

                        //refund entry in Jv
                        $cashbook = Cashbook::where('economic_segment_id', $retire_liability->economic_segment_id)->first();

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

                            //refund rv
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
                                'employee_id' => $retire_liability->employee_id,
                                'company_id' => $retire_liability->company_id,
                                'total_amount' => $retire_liability->amount,
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
                                'amount' => $retire_liability->amount
//                                'amount' => $paymentVoucher->total_amount->amount - $retireAmount
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

                    //insert into trail report
                    $jds = JournalVoucherDetail::where('journal_voucher_id', $jv->id)->get();
                    foreach ($jds as $jd) {
                        $jd = $jd->toArray();
                        $jvRepository = new JournalVoucherRepository();
                        $jvRepository->insertInTrailReport($jd);
                    }

                }

                $retireVLog = RetireVoucherLog::where('retire_voucher_id', $retireVoucher->id)->orderBy('id', 'DESC')->first();

                if ($retireVLog && ($data['data']['status'] != AppConstant::VOUCHER_STATUS_NEW)) {

                    if (Carbon::parse($retireVLog->date)->toDateString() > Carbon::parse($data['data']['date'])->toDateString()) {
                        if ($retireVLog->date != Carbon::now()->toDateString()) {
                            throw new AppException('Current Date should be greater than previous date');
                        }
                    }

                    RetireVoucherLog::create([
                        'retire_voucher_id' => $retireVoucher->id,
                        'previous_status' => $retireVoucher->status,
                        'current_status' => $data['data']['retire_status'],
                        'date' => $data['data']['date'],
                        'admin_id' => $data['data']['user_id']
                    ]);
                }elseif ($retireVLog && ($data['data']['status'] == AppConstant::VOUCHER_STATUS_NEW)){
                    RetireVoucherLog::create([
                        'retire_voucher_id' => $retireVoucher->id,
                        'previous_status' => $retireVoucher->status,
                        'current_status' => $data['data']['retire_status'],
                        'date' => $data['data']['date'],
                        'admin_id' => $data['data']['user_id']
                    ]);
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

    public function deleteLiability($data)
    {
        $data['id'] = $data['data']['id'];
        $retireVoucher = RetireVoucher::whereHas('retire_liabilities', function ($q) use ($data) {
            $q->where('id', $data['data']['id']);
        })->first();

        if (is_null($retireVoucher)) {
            throw new AppException('Retire Voucher Not Exist');
        }
        if ($retireVoucher->status != AppConstant::RETIRE_VOUCHER_NEW) {
            throw new AppException('Cannot delete liability Retire Voucher Status is not New');
        }
        $this->model = RetireLiability::class;
        return parent::delete($data);

    }

    public function downloadRetireVoucherReport($params)
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
            'paying_officer',
            'checking_officer',
            'financial_controller',
            'retire_voucher.retire_liabilities.economic_segment',
            'retire_voucher.retire_liabilities.company',
            'retire_voucher.retire_liabilities.employee',
            'retire_voucher.total_amount'
        ])->find($params['inputs']['id']);

        if (!(isset($paymentV->retire_voucher) && $paymentV->retire_voucher->retire_liabilities->isNotEmpty())) {
            throw new AppException('Add Retire Voucher Liability First');
        }

        $companyInformation = CompanyInformation::find(1);
        $payees = " ";
        $address = " ";
        $count = -1;
        /** @var RetireLiability $retire_liability */
        foreach ($paymentV->retire_voucher->retire_liabilities as $retire_liability) {
            if ($retire_liability->employee_id) {
                $payees = $retire_liability->employee->first_name . ' ';
                $address = $retire_liability->employee->employee_contact_details->country->name;
            } else {
                $payees = $retire_liability->company->name . ' ';
                $address = $retire_liability->company->country;
            }
            $count += 1;
        }
        $paymentV->default_setting = DefaultSetting::with([
            'checking_officer',
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

        $eCombineCodes = str_split(str_replace('-', '', $paymentV->economic_segment->combined_code));
        if (count($eCombineCodes) < 8) {
            $esTds = 8 - count($eCombineCodes);
            while ($esTds > 0) {
                $eCombineCodes[] = '';
                $esTds--;
            }
        }
        $paymentV['e_code'] = $eCombineCodes;

        // There must be 32 columns
        $fCombineCode = str_split(str_replace('-', '', $paymentV->functional_segment->combined_code));
        $psCombineCode = str_split(str_replace('-', '', $paymentV->program_segment->combined_code));
        $fsCombineCode = str_split(str_replace('-', '', $paymentV->fund_segment->combined_code));
        $gCombineCode = str_split(str_replace('-', '', $paymentV->geo_code_segment->combined_code));

        if (($remainingColumns = 32 - (count($fCombineCode) + count($psCombineCode) + count($fsCombineCode) + count($gCombineCode))) > 0) {
            if (count($fCombineCode) < 5 && $remainingColumns) {
                $esTds = 5 - count($fCombineCode);
                while ($esTds > 0 && $remainingColumns > 0) {
                    $fCombineCode[] = '';
                    $esTds--;
                    $remainingColumns--;
                }
            }
            if (count($psCombineCode) < 14 && $remainingColumns) {
                $esTds = 14 - count($psCombineCode);
                while ($esTds > 0 && $remainingColumns > 0) {
                    $psCombineCode[] = '';
                    $esTds--;
                    $remainingColumns--;
                }
            }
            if (count($fsCombineCode) < 5 && $remainingColumns) {
                $esTds = 5 - count($fsCombineCode);
                while ($esTds > 0 && $remainingColumns > 0) {
                    $fsCombineCode[] = '';
                    $esTds--;
                    $remainingColumns--;
                }
            }
            if (count($gCombineCode) < 8 && $remainingColumns) {
                $esTds = 8 - count($gCombineCode);
                while ($esTds > 0 && $remainingColumns > 0) {
                    $gCombineCode[] = '';
                    $esTds--;
                    $remainingColumns--;
                }
            }
        }
        $paymentV['f_code'] = $fCombineCode;
        $paymentV['ps_code'] = $psCombineCode;
        $paymentV['fs_code'] = $fsCombineCode;
        $paymentV['g_code'] = $gCombineCode;

        $paymentV['date'] = str_split(Carbon::parse($paymentV->retire_voucher->created_at)->format('d'));
        $paymentV['date'] = array_merge($paymentV['date'], str_split(Carbon::parse($paymentV->value_date)->format('m')));
        $paymentV['date'] = array_merge($paymentV['date'], str_split(Carbon::parse($paymentV->value_date)->format('Y')));

        $amounts = explode('.', $paymentV->retire_voucher->total_amount->amount);
        $paymentV['amount'] = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amounts[0]);
        $paymentV['paisa'] = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amounts[1] ?? 00);

        if (isset($params['inputs']['bs'])) {
            app()->make(WKHTMLPDfConverter::class)
                ->convertBrowserShot(view('reports.retire-voucher-report', ['data' => $paymentV])->render(), $fileName);
        } else {
            app()->make(WKHTMLPDfConverter::class)
                ->convert(view('reports.retire-voucher-report', ['data' => $paymentV])->render(), $fileName);
        }


        return ['url' => url($filePath . $fileName)];
    }

}
