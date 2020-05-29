<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeBackground;

class EmployeeBackgroundRepository extends EloquentBaseRepository
{
    public $model = EmployeeBackground::class;

    public function getAll($params = [], $query = null)
    {

        $query = EmployeeBackground::with([
            'employee'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }

    public function show($id, $params = null)
    {
        $data = EmployeeBackground::with([
            'employee'
        ])
            ->where('employee_id', $id['employeeId'])->where('id', $id['id'])->first();
        return $data;
    }
}
