<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PayeeVoucher;

class PayeeVoucherRepository extends EloquentBaseRepository
{

    public $model = PayeeVoucher::class;

    public function create($data)
    {
        return parent::create($data);
    }
}
