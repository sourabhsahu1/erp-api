<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Leave;

class LeaveRepository extends EloquentBaseRepository
{

    public $model = Leave::class;
}