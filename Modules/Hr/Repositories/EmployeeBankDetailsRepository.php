<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeBankDetail;

class EmployeeBankDetailsRepository extends EloquentBaseRepository
{
    public $model = EmployeeBankDetail::class;

    public function create($data)
    {
        $employeeBankDetail = EmployeeBankDetail::where('bank_id', $data['data']['bank_id'])
            ->where('bank_branch_id', $data['data']['bank_branch_id'])
            ->where('employee_id', $data['data']['employee_id'])
            ->first();
        if (is_null($employeeBankDetail)) {
            $employeeBankDetail =  parent::create($data);
        }
        return $employeeBankDetail;
    }


    public function update($data)
    {

        $employeeBankDetail = EmployeeBankDetail::where('id', $data['id'])
            ->where('employee_id', $data['data']['employee_id'])->first();
        if (is_null($employeeBankDetail)) {
            return parent::update($data);
        }else {
            throw new AppException('Invalid or Already deleted');
        }
    }

    public function getAll($params = [], $query = null)
    {
        $query = EmployeeBankDetail::with([
            'employee',
            'bank',
            'branches'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }

    public function show($id, $params = null)
    {
        $data = EmployeeBankDetail::with([
            'employee',
            'bank',
            'branches'
        ])
            ->where('employee_id', $id['employeeId'])->where('id', $id['id'])->first();
        return $data;
    }
}
