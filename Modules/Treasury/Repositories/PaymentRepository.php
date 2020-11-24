<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentVoucher;

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
        }else {
            $query->where('voucher_source_unit_id', 1);
        }

        if (isset($params['inputs']['status'])) {
            $query->where('status', $params['inputs']['status']);
        }
        return parent::getAll($params, $query);
    }

}
