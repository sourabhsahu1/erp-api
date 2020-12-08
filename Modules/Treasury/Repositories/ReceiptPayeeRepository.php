<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\ReceiptPayee;

class ReceiptPayeeRepository extends EloquentBaseRepository
{
    public $model = ReceiptPayee::class;
}
