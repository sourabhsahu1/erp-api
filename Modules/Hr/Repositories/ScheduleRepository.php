<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Schedule;

class ScheduleRepository extends EloquentBaseRepository
{

    public $model = Schedule::class;
}