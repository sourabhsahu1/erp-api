<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\ScheduleEconomic;

class ScheduleEconomicsRepository extends EloquentBaseRepository
{

    public $model = ScheduleEconomic::class;
}
