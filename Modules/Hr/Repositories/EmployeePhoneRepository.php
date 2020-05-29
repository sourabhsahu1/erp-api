<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeePhoneNumber;

class EmployeePhoneRepository extends EloquentBaseRepository
{

    public $model = EmployeePhoneNumber::class;

    public function getAll($params = [], $query = null)
    {
        $query = EmployeePhoneNumber::with([
            'phone_number_type',
            'employee'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }

    public function show($id, $params = null)
    {
        $data = EmployeePhoneNumber::with([
            'phone_number_type',
            'employee'
        ])
            ->where('employee_id', $id['employeeId'])->where('id', $id['id'])->first();
        return $data;
    }
}
