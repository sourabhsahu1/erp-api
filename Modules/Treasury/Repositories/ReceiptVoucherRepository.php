<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use App\Services\WKHTMLPDfConverter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanySetting;
use Modules\Finance\Models\Currency;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;
use Modules\Treasury\Models\Cashbook;
use Modules\Treasury\Models\DefaultSetting;
use Modules\Treasury\Models\ReceiptPayee;
use Modules\Treasury\Models\ReceiptScheduleEconomic;
use Modules\Treasury\Models\ReceiptVoucher;
use Modules\Treasury\Models\ReceiptVoucherLog;
use Modules\Treasury\Models\VoucherSourceUnit;

class ReceiptVoucherRepository extends EloquentBaseRepository
{

    public $model = ReceiptVoucher::class;


    public function create($data)
    {
        $receiptV = ReceiptVoucher::latest()->orderby('id', 'desc')->first();

        if (is_null($receiptV)) {
            $data['data']['deptal_id'] = 1;
        } else {
            $data['data']['deptal_id'] = $receiptV->deptal_id + 1;
        }
        $data['data']['status'] = 'NEW';

        $rv = parent::create($data);
        ReceiptVoucherLog::create([
            'receipt_voucher_id' => $rv->id,
            'previous_status' => null,
            'current_status' => 'NEW',
            'date' => \Carbon\Carbon::now()->toDateString(),
            'admin_id' => $data['data']['user_id']
        ]);
        return $rv;
    }


    public function getAll($params = [], $query = null)
    {
        $query = ReceiptVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'receiving_officer',
            'prepared_by_officer',
            'closed_by_officer',
            'receipt_payees',
            'receipt_schedule_economic',
            'voucher_source_unit',
            'total_amount'
        ]);

        if (isset($params['inputs']['source_unit'])) {
            $query->where('voucher_source_unit_id', $params['inputs']['source_unit']);
        }
        if (isset($params['inputs']['search'])) {
            $query->where(function ($d) use ($params) {
                $d->where('deptal_id', 'like', "%" . $params['inputs']['search'] . "%")
                    ->orWhere('payment_description', 'like', "%" . $params['inputs']['search'] . "%");
            });
        }

        if (isset($params['inputs']['status'])) {
            $query->where('status', $params['inputs']['status']);
        }
        /* $query->with(['total_tax' => function ($tax) {
             $tax->selectRaw('SUM(total_tax)');
         }]);*/

        return parent::getAll($params, $query);
    }

    public function typePaymentVoucher($params)
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
                            'name' => 'DEPOSIT RECEIVED VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_DEPOSIT_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'NON PERSONAL ADVANCES RECEIVED VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_NON_PERSONAL_ADVANCES_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'SPECIAL IMPREST RECEIVED VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_SPECIAL_IMPREST_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'STANDING IMPREST RECEIVED VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_STANDING_IMPREST_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'REMITTANCE RECEIVED VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_REMITTANCE_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'REVENUE DEBIT VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_REVENUE_DEBIT_VOUCHER
                        ]
                    ]
                ];
            } elseif ($vsu->is_personal_advance_unit == false) {

                return [
                    'type' => [

                        [
                            'name' => 'REVENUE VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_REVENUE_VOUCHER
                        ],
                        [
                            'name' => 'REVENUE DEBIT VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_REVENUE_DEBIT_VOUCHER
                        ]
                    ]
                ];
            }
        }

    }

    public function updateStatus($data)
    {

        $rv = ReceiptVoucher::whereIn('id', $data['data']['receipt_voucher_ids']);

        DB::beginTransaction();
        try {
            foreach ($data['data']['receipt_voucher_ids'] as $receipt_voucher_id) {

                $rv = ReceiptVoucher::where('id', $receipt_voucher_id)->first();

                if (is_null($rv)) {
                    throw  new AppException('receipt voucher not exists');
                }
                $payeeVoucherIds = ReceiptPayee::where('receipt_voucher_id', $rv->id)->pluck('id')->all();

                if (is_null($payeeVoucherIds)) {
                    throw new AppException('Payee not added');
                }

                $scheduleVoucher = ReceiptScheduleEconomic::whereIn('receipt_payee_id', $payeeVoucherIds)->first();

                if (is_null($scheduleVoucher)) {
                    throw new AppException('Schedule Economic not added');
                }


                $rvLog = ReceiptVoucherLog::where('receipt_voucher_id', $rv->id)->orderBy('id', 'DESC')->first();

                if ($rvLog && ($data['data']['status'] != AppConstant::VOUCHER_STATUS_NEW)) {
                    if ($rvLog->current_status > Carbon::parse($data['data']['date'])->toDateString()) {
                        throw new AppException('Data should be greater than previous');
                    }
                    ReceiptVoucherLog::create([
                        'receipt_voucher_id' => $rv->id,
                        'previous_status' => $rv->status,
                        'current_status' => $data['data']['status'],
                        'date' => $data['data']['date'],
                        'admin_id' => $data['data']['user_id']
                    ]);
                }elseif ($rvLog && ($data['data']['status'] == AppConstant::VOUCHER_STATUS_NEW)) {
                    ReceiptVoucherLog::create([
                        'receipt_voucher_id' => $rv->id,
                        'previous_status' => $rv->status,
                        'current_status' => $data['data']['status'],
                        'date' => $data['data']['date'],
                        'admin_id' => $data['data']['user_id']
                    ]);
                }
            }


            if (isset($data['data']['status'])) {
                if ($data['data']['status'] == AppConstant::RECEIPT_VOUCHER_STATUS_POSTED_TO_GL) {
                    $retireVouchers = ReceiptVoucher::with(['receipt_payees.treasury_receipt_schedule_economics'])
                        ->whereIn('id', $data['data']['receipt_voucher_ids'])
                        ->get();

                    $companySetting = CompanySetting::find(1);
                    foreach ($retireVouchers as $retireVoucher) {
                        $cashbook = Cashbook::find($retireVoucher->cashbook_id);
                        $currencyId = $retireVoucher->cashbook->currency_id;
                        $currency = Currency::find($currencyId);

                        $jv = JournalVoucher::create([
                            'source_app' => 'E-Voucher (Treasury)',
                            'batch_number' => 1,
                            'jv_value_date' => Carbon::now()->toDateTimeString(),
                            'fund_segment_id' => $retireVoucher->fund_segment_id,
                            'jv_reference' => $retireVoucher->source_department,
                            'status' => AppConstant::VOUCHER_STATUS_NEW,
                            'transaction_details' => $retireVoucher->payment_description,
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

                        /** @var ReceiptPayee $receipt_payee */

                        $jvD = null;
                        $totalNetAmount = 0;
                        foreach ($retireVoucher->receipt_payees as $receipt_payee) {
                            /** @var ReceiptScheduleEconomic $schedule_economic */
                            foreach ($receipt_payee->treasury_receipt_schedule_economics as $schedule_economic) {

                                $jvD[] = [
                                    'journal_voucher_id' => $jv->id,
                                    'currency' => $currency->code_currency,
                                    'x_rate_local' => $retireVoucher->x_rate,
                                    'bank_x_rate_to_usd' => $retireVoucher->official_x_rate,
                                    'account_name' => $retireVoucher->deptal_id,
                                    'line_reference' => $retireVoucher->deptal_id,
                                    'line_value' => $schedule_economic->amount,
                                    'admin_segment_id' => $retireVoucher->admin_segment_id,
                                    'fund_segment_id' => $retireVoucher->fund_segment_id,
                                    'economic_segment_id' => $schedule_economic->economic_segment_id,
                                    'programme_segment_id' => $retireVoucher->program_segment_id,
                                    'functional_segment_id' => $retireVoucher->functional_segment_id,
                                    'geo_code_segment_id' => $retireVoucher->geo_code_segment_id,
                                    'line_value_type' => 'CREDIT',
                                    'lv_line_value' => $schedule_economic->amount,
                                    'local_currency' => $companySetting->local_currency,
                                    'created_at' => Carbon::now()->toDateTimeString(),
                                    'updated_at' => Carbon::now()->toDateTimeString()
                                ];

                                $totalNetAmount = $totalNetAmount + $schedule_economic->amount;

                            }
                        }

                        //entry for cashbook credit
                        //todo credit updation pending in cashbook on respected economic segment
                        JournalVoucherDetail::create([
                            'journal_voucher_id' => $jv->id,
                            'currency' => $currency->code_currency,
                            'x_rate_local' => $retireVoucher->x_rate,
                            'bank_x_rate_to_usd' => $retireVoucher->official_x_rate,
                            'account_name' => $retireVoucher->deptal_id,
                            'line_reference' => $retireVoucher->deptal_id,
                            'line_value' => $totalNetAmount,
                            'admin_segment_id' => $retireVoucher->admin_segment_id,
                            'fund_segment_id' => $retireVoucher->fund_segment_id,
                            'economic_segment_id' => $cashbook->economic_segment_id,
                            'programme_segment_id' => $retireVoucher->program_segment_id,
                            'functional_segment_id' => $retireVoucher->functional_segment_id,
                            'geo_code_segment_id' => $retireVoucher->geo_code_segment_id,
                            'line_value_type' => 'DEBIT',
                            'lv_line_value' => $totalNetAmount,
                            'local_currency' => $companySetting->local_currency,
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);
                        JournalVoucherDetail::insert($jvD);

                    }
                }
                $rv->update([
                    'status' => $data['data']['status']
                ]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }


        return [
            'data' => 'Status Updated Successfully'
        ];
    }


    public function update($data)
    {

        $receiptVoucher = ReceiptVoucher::find($data['data']['id']);
        if ($receiptVoucher->status != AppConstant::VOUCHER_STATUS_NEW) {
            throw new AppException('Cannot Update status is not NEW');
        }


        return parent::update($data);
    }


    public function delete($data)
    {
        $receiptVoucher = ReceiptVoucher::find($data['id']);
        if ($receiptVoucher->status != AppConstant::VOUCHER_STATUS_NEW) {
            throw new AppException('Cannot delete status is not NEW');
        }

        ReceiptScheduleEconomic::where('receipt_voucher_id', $receiptVoucher->id)->delete();
        ReceiptPayee::where('receipt_voucher_id', $receiptVoucher->id)->delete();

        return parent::delete($data); // TODO: Change the autogenerated stub
    }

    public function statusReceiptVoucher()
    {
        return [
            'status' => [
                [
                    'name' => 'NEW',
                    'value' => 'NEW'
                ],
                [
                    'name' => 'CLOSED',
                    'value' => 'CLOSED'
                ],
                [
                    'name' => 'POSTED TO GL',
                    'value' => 'POSTED_TO_GL'
                ]
            ]
        ];
    }

    public function downloadReceiptReport($data)
    {

        $fileName = 'receipt-voucher' . \Carbon\Carbon::now()->toDateTimeString() . '.pdf';
        $filePath = "pdf/";

        /** @var ReceiptVoucher $receipt */
        $receipt = ReceiptVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'employee',
            'receipt_payees',
            'receipt_schedule_economic',
            'voucher_source_unit',
            'total_amount'
        ])->find($data['data']['id']);

        $final_text = " ";
        $count = 1;

        /** @var ReceiptPayee $receipt_payee */

        if (is_null($receipt) || is_null($receipt->receipt_payees)) {
            throw new AppException("Payers not found , Cannot create View file");
        }

        foreach ($receipt->receipt_payees as $receipt_payee) {
            if ($receipt_payee->employee_id) {
                $count += 1;
                $final_text = $final_text . $receipt_payee->details . '[' . $receipt_payee->employee->first_name . ']' . ' ;';
            } else {
                $count += 1;
                $final_text = $final_text . $receipt_payee->details . '[' . $receipt_payee->admin_company->name . ']' . ' ;';
            }
        }

        $receipt->default_setting = DefaultSetting::with(['checking_officer',
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

        $receipt->final_text = $final_text;

        app()->make(WKHTMLPDfConverter::class)
            ->convert(view('reports.receipt-voucher-report', ['data' => $receipt])->render(), $fileName);

        return ['url' => url($filePath . $fileName)];
    }

}
