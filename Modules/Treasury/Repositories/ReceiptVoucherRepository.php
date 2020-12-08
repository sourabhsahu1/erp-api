<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\ReceiptVoucher;
use Modules\Treasury\Models\VoucherSourceUnit;

class ReceiptVoucherRepository extends EloquentBaseRepository
{

    public $model = ReceiptVoucher::class;


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


}
