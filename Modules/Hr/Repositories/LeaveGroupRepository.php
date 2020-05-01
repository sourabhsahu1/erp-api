<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\LeaveGroup;

class LeaveGroupRepository extends EloquentBaseRepository
{

    public $model = LeaveGroup::class;
}