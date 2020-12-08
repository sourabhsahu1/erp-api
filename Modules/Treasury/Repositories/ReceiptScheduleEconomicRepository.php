<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\ReceiptScheduleEconomic;

class ReceiptScheduleEconomicRepository extends  EloquentBaseRepository
{
    public $model = ReceiptScheduleEconomic::class;
}
