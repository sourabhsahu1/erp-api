<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Department;

class DepartmentRepository extends EloquentBaseRepository
{
    public $model = Department::class;
}