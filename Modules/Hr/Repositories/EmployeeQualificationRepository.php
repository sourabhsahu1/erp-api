<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeQualification;

class EmployeeQualificationRepository extends EloquentBaseRepository
{
    public $model = EmployeeQualification::class;
    public function getAll($params = [], $query = null)
    {
        $query = EmployeeQualification::with([
            'academic',
            'employee',
            'country',
            'qualification'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }
}
