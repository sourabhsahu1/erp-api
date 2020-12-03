<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\VoucherSourceUnit;

class PaymentRepository extends EloquentBaseRepository
{
    public $model = PaymentVoucher::class;

    public function create($data)
    {
        $paymentV = PaymentVoucher::latest()->orderby('id', 'desc')->first();

        if (is_null($paymentV)) {
            $data['data']['deptal_id'] = 1;
        } else {
            $data['data']['deptal_id'] = $paymentV->deptal_id + 1;
        }
        $data['data']['status'] = 'NEW';

        return parent::create($data);
    }

    public function update($data)
    {

        return parent::update($data);
    }

    public function getAll($params = [], $query = null)
    {
        $query = PaymentVoucher::query();

        if (isset($params['inputs']['voucher_source_unit_id'])) {
            $query->where('voucher_source_unit_id', $params['inputs']['voucher_source_unit_id']);
        }

        if (isset($params['inputs']['status'])) {
            $query->where('status', $params['inputs']['status']);
        }
        return parent::getAll($params, $query);
    }


    public function updateStatus($data)
    {

        $pv = PaymentVoucher::whereIn('id', $data['data']['payment_voucher_ids']);

        //todo validation for payee added or not and their bank account
        $pv->update([
            'status' => $data['data']['status']
        ]);

        return [
            'data' => 'Status Updated Successfully'
        ];
    }

    public function typePaymentVoucher($params)
    {
        /** @var VoucherSourceUnit $vsu */
        $vsu = VoucherSourceUnit::where('id', $params['inputs']['voucher_source_unit_id'])->first();

        if (is_null($vsu)) {
            throw new AppException('voucher source unit not exist');
        } else {

            if ($vsu->is_personal_advance_unit == true) {
                return [
                    'type' => [
                        AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER,
                        AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER,
                        AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER,
                        AppConstant::VOUCHER_TYPE_STANDING_VOUCHER
                    ]
                ];
            } elseif ($vsu->is_personal_advance_unit == false) {

                return [
                    'type' => [
                        AppConstant::VOUCHER_TYPE_TRANSFER_CASHBOOK_VOUCHER,
                        AppConstant::VOUCHER_TYPE_DEPOSIT_VOUCHER,
                        AppConstant::VOUCHER_TYPE_REMITTANCE_VOUCHER,
                        AppConstant::VOUCHER_TYPE_EXPENDITURE_VOUCHER,
                        AppConstant::VOUCHER_TYPE_EXPENDITURE_CREDIT_VOUCHER
                    ]
                ];
            }
        }


    }
}
