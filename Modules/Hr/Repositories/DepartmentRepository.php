<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Department;

class DepartmentRepository extends EloquentBaseRepository
{
    public $model = Department::class;

    public function getAll($params = [], $query = null)
    {

        $query = Department::with('sub_categories')->where('parent_id', null);
        return $query->get();
    }
}