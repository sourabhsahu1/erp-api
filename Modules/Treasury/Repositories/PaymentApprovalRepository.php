<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentApproval;

class PaymentApprovalRepository extends EloquentBaseRepository
{

    public $model = PaymentApproval::class;
}
