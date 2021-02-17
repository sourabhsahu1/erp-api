<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use App\Services\WKHTMLPDfConverter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanySetting;
use Modules\Admin\Models\Tax;
use Modules\Finance\Models\Currency;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;
use Modules\Treasury\Models\Mandate;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentApproval;
use Modules\Treasury\Models\PaymentApprovalPayee;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ReceiptVoucher;
use Modules\Treasury\Models\ScheduleEconomic;
use Modules\Treasury\Models\VoucherSourceUnit;

class MandateRepository extends EloquentBaseRepository
{


    public $model = Mandate::class;

    public function getAll($params = [], $query = null)
    {
        $query = Mandate::query();
        if (isset($params['inputs']['search'])) {
            $query = $query->where('id', $params['inputs']['search'])
                ->orWhereHas('cashbook', function ($query) use ($params) {
                    $query->where('cashbook_title', $params['inputs']['search']);
                });
        }
        return parent::getAll($params, $query);
    }

    public function create($data)
    {

        DB::beginTransaction();
        try {

            $data['data']['status'] = 'NEW';
            $data['data']['prepared_by'] = $data['data']['user_id'];
            $data['data']['prepared_date'] = Carbon::now()->toDateString();
            $mandate = parent::create($data);

            if (isset($data['data']['payment_vouchers'])) {


                $data['data']['payment_vouchers'] = json_decode($data['data']['payment_vouchers'], true);


                $paymentV = PaymentVoucher::whereIn('id', $data['data']['payment_vouchers']);

//                foreach ($paymentV->get() as $value) {
//                    /** @var VoucherSourceUnit $vsu */
//                    $vsu = VoucherSourceUnit::find($value->voucher_source_unit_id);
//                    if ($vsu->is_personal_advance_unit == true) {
//                        throw new AppException('Advance Vouchers not Allowed');
//                    }
//                }

                $paymentV = $paymentV->whereIn('status', [
                    AppConstant::VOUCHER_STATUS_AUDITED
                ])->get();


//                Log::info($paymentV);

                if ($paymentV->isEmpty()) {
                    throw new AppException('payment vouchers are not audited');
                }

                /** @var PaymentVoucher $payment */
                foreach ($paymentV as $payment) {
                    if (strtotime($data['data']['value_date']) < strtotime($payment->value_date)) {
                        throw new AppException('mandate date cannot be before than PV\'s value date');
                    }
                }

                $paymentVouchers = PaymentVoucher::whereIn('id', $data['data']['payment_vouchers'])
                    ->update([
                        'mandate_id' => $mandate->id,
                        'status' => AppConstant::VOUCHER_STATUS_ON_MANDATE
                    ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }

        return $mandate;
    }

    public function update($data)
    {

        $mandate = Mandate::find($data['data']['id']);

        if ($mandate->status != AppConstant::ON_MANDATE_NEW) {
            if ($data['data']['status'] != AppConstant::RETIRE_VOUCHER_NEW) {
                throw new AppException('Cannot update Mandate Status is not NEW');
            }
        }

        if (isset($data['data']['payment_vouchers'])) {

            $data['data']['payment_vouchers'] = json_decode($data['data']['payment_vouchers'], true);
            $paymentVouchers = PaymentVoucher::whereIn('id', $data['data']['payment_vouchers'])
                ->update([
                    'mandate_id' => $data['data']['id']
                ]);
        }

        return parent::update($data);
    }

    public function mandateUpdate($data)
    {

        $data['data']['mandate_ids'] = json_decode($data['data']['mandate_ids']);

        foreach ($data['data']['mandate_ids'] as $mandate_id) {
            DB::beginTransaction();
            try {
                if (isset($data['data']['status'])) {
                    if ($data['data']['status'] == AppConstant::ON_MANDATE_1ST_AUTHORISED) {
                        $data['data']['first_authorised_by'] = $data['data']['user_id'];
                        $data['data']['first_authorised_date'] = Carbon::now()->toDateString();
                    }

                    if ($data['data']['status'] == AppConstant::ON_MANDATE_2ND_AUTHORISED) {
                        $data['data']['second_authorised_by'] = $data['data']['user_id'];
                        $data['data']['second_authorised_date'] = Carbon::now()->toDateString();

                        //payment voucher to be closed when on mandate 2nd auth
                        PaymentVoucher::where('mandate_id', $mandate_id)->update([
                            'status' => AppConstant::VOUCHER_STATUS_CLOSED
                        ]);


                        /** @var CompanySetting $companySetting */
                        $companySetting = CompanySetting::find(1);

                        if ($companySetting->is_payment_approval == false) {
                            $paymentVouchers = PaymentVoucher::with(['payee_vouchers.schedule_economics'])->where('mandate_id', $mandate_id)->get();

                            /** @var PaymentVoucher $paymentVoucher */
                            foreach ($paymentVouchers as $paymentVoucher) {
                                /** @var PayeeVoucher $payee_voucher */
                                $paymentApproval = PaymentApproval::create([
                                    'admin_segment_id' => $paymentVoucher->admin_segment_id,
                                    'fund_segment_id' => $paymentVoucher->fund_segment_id,
                                    'economic_segment_id' => $paymentVoucher->economic_segment_id,
                                    'employee_customer' => $paymentVoucher->payee,
                                    'prepared_by_id' => $paymentVoucher->paying_officer_id,
                                    'currency_id' => $paymentVoucher->currency_id,
                                    'value_date' => $paymentVoucher->value_date,
                                    'authorised_date' => $paymentVoucher->value_date,
                                    'remark' => $paymentVoucher->payment_description,
                                    'status' => AppConstant::PAYMENT_APPROVAL_FULLY_USED
                                ]);

                                foreach ($paymentVoucher->payee_vouchers as $payee_voucher) {
                                    $paymentApprovalPayee[] = [
                                        'payment_approval_id' => $paymentApproval->id,
                                        'year' => $payee_voucher->year,
                                        'details' => $payee_voucher->details,
                                        'employee_id' => $payee_voucher->employee_id ?? null,
                                        'company_id' => $payee_voucher->company_id ?? null,
                                        'net_amount' => $payee_voucher->net_amount,
                                        'total_tax' => $payee_voucher->total_tax,
                                        'tax_ids' => $payee_voucher->tax_ids
                                    ];
                                }
                                if (count($paymentApprovalPayee) > 0)
                                    PaymentApprovalPayee::insert($paymentApprovalPayee);
                            }
                        }

                    }

                    if ($data['data']['status'] == AppConstant::ON_MANDATE_POSTED_TO_GL) {
                        //payment voucher to be post to gl when on mandate post to gl

                        PaymentVoucher::where('mandate_id', $mandate_id)->update([
                            'status' => AppConstant::VOUCHER_STATUS_POSTED_TO_GL
                        ]);

                        //todo jv from pv

                        $companySetting = CompanySetting::find(1);

                        $paymentVouchers = PaymentVoucher::with(['payee_vouchers.schedule_economics'])->where('mandate_id', $mandate_id)->get();

                        /** @var PaymentVoucher $paymentVoucher */
                        foreach ($paymentVouchers as $paymentVoucher) {
                            $currency = Currency::find($paymentVoucher->currency_id);
                            $jv = JournalVoucher::create([
                                'source_app' => 'E-Voucher (Treasury)',
                                'batch_number' => 1,
                                'jv_value_date' => Carbon::now()->toDateTimeString(),
                                'fund_segment_id' => $paymentVoucher->fund_segment_id,
                                'jv_reference' => $paymentVoucher->source_unit,
                                'status' => AppConstant::VOUCHER_STATUS_NEW,
                                'transaction_details' => $paymentVoucher->payment_description,
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

                            /** @var PayeeVoucher $payee_voucher */

                            $jvD = null;
                            $totalNetAmount = 0;
                            $totalTax = 0;
                            foreach ($paymentVoucher->payee_vouchers as $payee_voucher) {
                                foreach (json_decode($payee_voucher->tax_ids, true) as $tax_id) {
                                    /** @var Tax $tax */
                                    $tax = Tax::find($tax_id);
                                    if ($tax) {
                                        $jvD[] = [
                                            'journal_voucher_id' => $jv->id,
                                            'currency' => $currency->code_currency,
                                            'x_rate_local' => $paymentVoucher->x_rate,
                                            'bank_x_rate_to_usd' => $paymentVoucher->official_x_rate,
                                            'account_name' => $paymentVoucher->deptal_id,
                                            'line_reference' => $paymentVoucher->deptal_id,
                                            'line_value' => ($tax->tax * $payee_voucher->net_amount) / 100,
                                            'admin_segment_id' => $paymentVoucher->admin_segment_id,
                                            'fund_segment_id' => $paymentVoucher->fund_segment_id,
                                            'economic_segment_id' => $tax->department_id,
                                            'programme_segment_id' => $paymentVoucher->program_segment_id,
                                            'functional_segment_id' => $paymentVoucher->functional_segment_id,
                                            'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
                                            'line_value_type' => 'CREDIT',
                                            'lv_line_value' => ($tax->tax * $payee_voucher->net_amount) / 100,
                                            'local_currency' => $companySetting->local_currency,
                                            'created_at' => Carbon::now()->toDateTimeString(),
                                            'updated_at' => Carbon::now()->toDateTimeString()
                                        ];
                                    }
                                }
                                /** @var ScheduleEconomic $schedule_economic */
                                foreach ($payee_voucher->schedule_economics as $schedule_economic) {

                                    $jvD[] = [
                                        'journal_voucher_id' => $jv->id,
                                        'currency' => $currency->code_currency,
                                        'x_rate_local' => $paymentVoucher->x_rate,
                                        'bank_x_rate_to_usd' => $paymentVoucher->official_x_rate,
                                        'account_name' => $paymentVoucher->deptal_id,
                                        'line_reference' => $paymentVoucher->deptal_id,
                                        'line_value' => $schedule_economic->amount,
                                        'admin_segment_id' => $paymentVoucher->admin_segment_id,
                                        'fund_segment_id' => $paymentVoucher->fund_segment_id,
                                        'economic_segment_id' => $schedule_economic->economic_segment_id,
                                        'programme_segment_id' => $paymentVoucher->program_segment_id,
                                        'functional_segment_id' => $paymentVoucher->functional_segment_id,
                                        'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
                                        'line_value_type' => 'DEBIT',
                                        'lv_line_value' => $schedule_economic->amount,
                                        'local_currency' => $companySetting->local_currency,
                                        'created_at' => Carbon::now()->toDateTimeString(),
                                        'updated_at' => Carbon::now()->toDateTimeString()
                                    ];


                                    $totalNetAmount = $totalNetAmount + $schedule_economic->amount;

                                }

                                $totalTax = $totalTax + $payee_voucher->total_tax;
                            }

                            //entry for credit
                            //todo credit updation pending in cashbook on respected ecnomic segment
                            JournalVoucherDetail::create([
                                'journal_voucher_id' => $jv->id,
                                'currency' => $currency->code_currency,
                                'x_rate_local' => $paymentVoucher->x_rate,
                                'bank_x_rate_to_usd' => $paymentVoucher->official_x_rate,
                                'account_name' => $paymentVoucher->deptal_id,
                                'line_reference' => $paymentVoucher->deptal_id,
                                'line_value' => $totalNetAmount,
                                'admin_segment_id' => $paymentVoucher->admin_segment_id,
                                'fund_segment_id' => $paymentVoucher->fund_segment_id,
                                'economic_segment_id' => $paymentVoucher->economic_segment_id,
                                'programme_segment_id' => $paymentVoucher->program_segment_id,
                                'functional_segment_id' => $paymentVoucher->functional_segment_id,
                                'geo_code_segment_id' => $paymentVoucher->geo_code_segment_id,
                                'line_value_type' => 'CREDIT',
                                'lv_line_value' => $totalNetAmount,
                                'local_currency' => $companySetting->local_currency,
                                'created_at' => Carbon::now()->toDateTimeString(),
                                'updated_at' => Carbon::now()->toDateTimeString()
                            ]);
                            JournalVoucherDetail::insert($jvD);
                        }
                    }
                }

                $data['id'] = $mandate_id;
                parent::update($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                throw $exception;
            }
        }

        return ['data' => 'Success'];
    }


    public function downloadMandateReport($data)
    {
        $fileName = 'mandate' . \Carbon\Carbon::now()->toDateTimeString() . '.pdf';
        $filePath = "pdf/";

        $mandate = Mandate::with([
            'cashbook.cashbook_monthly_balances',
            'cashbook.bank_branch',
            'cashbook.bank',
            'cashbook.currency',
            'cashbook.economic_segment',
            'cashbook.fund_owned',
            'first_authorised',
            'second_authorised',
            'prepared',
            'payment_vouchers.program_segment',
            'payment_vouchers.economic_segment',
            'payment_vouchers.functional_segment',
            'payment_vouchers.geo_code_segment',
            'payment_vouchers.admin_segment',
            'payment_vouchers.fund_segment',
            'payment_vouchers.aie',
            'payment_vouchers.currency',
            'payment_vouchers.voucher_source_unit',
            'payment_vouchers.total_amount',
            'payment_vouchers.total_tax',
            'payment_vouchers.payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payment_vouchers.payee_vouchers.employee.employee_bank.branches.hr_bank',
            'payment_vouchers.schedule_economic.economic_segment',
            'payment_vouchers.paying_officer',
            'payment_vouchers.checking_officer',
            'payment_vouchers.financial_controller'
        ])->find($data['data']['id']);

//        dd($mandate);
        app()->make(WKHTMLPDfConverter::class)
            ->convert(view('reports.mandate-report', ['data' => $mandate])->render(), $fileName);

        return ['url' => url($filePath . $fileName)];
    }


    public function downloadMandateTaxReport($data)
    {
        $fileName = 'mandate-cbn' . \Carbon\Carbon::now()->toDateTimeString() . '.pdf';
        $filePath = "pdf/";

        $mandate = Mandate::with([
            'cashbook.cashbook_monthly_balances',
            'cashbook.bank_branch',
            'cashbook.bank',
            'cashbook.currency',
            'cashbook.economic_segment',
            'cashbook.fund_owned',
            'first_authorised',
            'second_authorised',
            'prepared',
            'payment_vouchers.program_segment',
            'payment_vouchers.economic_segment',
            'payment_vouchers.functional_segment',
            'payment_vouchers.geo_code_segment',
            'payment_vouchers.admin_segment',
            'payment_vouchers.fund_segment',
            'payment_vouchers.aie',
            'payment_vouchers.currency',
            'payment_vouchers.voucher_source_unit',
            'payment_vouchers.total_amount',
            'payment_vouchers.total_tax',
            'payment_vouchers.payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payment_vouchers.payee_vouchers.employee.employee_bank.branches.hr_bank',
            'payment_vouchers.schedule_economic.economic_segment',
            'payment_vouchers.paying_officer',
            'payment_vouchers.checking_officer',
            'payment_vouchers.financial_controller'
        ])->find($data['data']['id']);


//        dd($mandate);
        app()->make(WKHTMLPDfConverter::class)
            ->convert(view('reports.mandate-tax-report', ['data' => $mandate])->render(), $fileName);

        return ['url' => url($filePath . $fileName)];
    }

}
