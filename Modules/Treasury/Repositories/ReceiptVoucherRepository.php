<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ReceiptPayee;
use Modules\Treasury\Models\ReceiptScheduleEconomic;
use Modules\Treasury\Models\ReceiptVoucher;
use Modules\Treasury\Models\ScheduleEconomic;
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

        return parent::create($data);
    }


    public function getAll($params = [], $query = null)
    {
        $query = ReceiptVoucher::query();

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
                            'name' => 'DEPOSIT RECEIVED',
                            'value' => AppConstant::VOUCHER_TYPE_DEPOSIT_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'NON PERSONAL ADVANCES RECEIVED',
                            'value' => AppConstant::VOUCHER_TYPE_NON_PERSONAL_ADVANCES_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'SPECIAL IMPREST RECEIVED',
                            'value' => AppConstant::VOUCHER_TYPE_SPECIAL_IMPREST_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'STANDING IMPREST RECEIVED',
                            'value' => AppConstant::VOUCHER_TYPE_STANDING_IMPREST_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'REMITTANCE RECEIVED',
                            'value' => AppConstant::VOUCHER_TYPE_REMITTANCE_RECEIVED_VOUCHER
                        ],
                        [
                            'name' => 'REVENUE DEBIT',
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
                            'name' => 'REVENUE DEBIT',
                            'value' => AppConstant::VOUCHER_TYPE_REVENUE_DEBIT_VOUCHER
                        ]
                    ]
                ];
            }
        }

    }

    public function updateStatus($data)
    {

        $pv = ReceiptVoucher::whereIn('id', $data['data']['receipt_voucher_ids']);

        foreach ($data['data']['receipt_voucher_ids'] as $receipt_voucher_id) {

            $pv = ReceiptVoucher::where('id', $receipt_voucher_id)->first();
            $payeeVoucherIds = ReceiptPayee::where('receipt_voucher_id', $pv->id)->pluck('id')->all();

            if (is_null($payeeVoucherIds)) {
                throw new AppException('Payee not added');
            }

            $scheduleVoucher = ReceiptScheduleEconomic::whereIn('receipt_payee_id', $payeeVoucherIds)->first();

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

}
