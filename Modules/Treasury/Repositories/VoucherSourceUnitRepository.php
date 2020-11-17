<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\VoucherSourceUnit;

class VoucherSourceUnitRepository extends EloquentBaseRepository
{
    public $model = VoucherSourceUnit::class;
}
