<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentApproval;

class PaymentApprovalRepository extends EloquentBaseRepository
{

    public $model = PaymentApproval::class;

    public function create($data)
    {
        $data['data']['status'] = 'NEW';
        return parent::create($data);
    }

    public function update($data)
    {
        PaymentApproval::whereIn('id', json_decode($data['data']['payment_approval_ids'],true))->update([
            'status' => $data['data']['status']
        ]);
    }

}
