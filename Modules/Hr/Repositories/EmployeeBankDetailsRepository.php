<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\BankBranch;
use Modules\Hr\Models\EmployeeBankDetail;

class EmployeeBankDetailsRepository extends EloquentBaseRepository
{
    public $model = EmployeeBankDetail::class;

    public function create($data)
    {

        $branch = BankBranch::find($data['data']['bank_branch_id']);
        $existingEmployeeBankAcc = EmployeeBankDetail::where('country', $branch->country)->where('number', $data['data']['number'])->first();

        if (!is_null($existingEmployeeBankAcc)) {
            throw new AppException('Choose Different Account');
        }
        $employeeBankDetail = EmployeeBankDetail::where('bank_id', $data['data']['bank_id'])
            ->where('bank_branch_id', $data['data']['bank_branch_id'])
            ->where('employee_id', $data['data']['employee_id'])
            ->first();

        if (is_null($employeeBankDetail)) {
            $data['data']['country'] = $branch->country;
            $employeeBankDetail = parent::create($data);
        }
        return $employeeBankDetail;
    }


    public function update($data)
    {

        /** @var EmployeeBankDetail $employeeBankDetail */
        $employeeBankDetail = EmployeeBankDetail::where('id', $data['id'])
            ->where('employee_id', $data['data']['employee_id'])->first();

        $branch = BankBranch::find($employeeBankDetail->bank_branch_id);

        $existingCurrentEmployeeBankAcc = EmployeeBankDetail::where('id', $data['id'])
            ->where('country', $branch->country)
            ->where('number', $data['data']['number'])
            ->first();

        $existingEmployeeBankAcc = EmployeeBankDetail::where('country', $branch->country)
            ->where('number', $data['data']['number'])
            ->first();

        if (!is_null($existingEmployeeBankAcc)) {
            if (is_null($existingCurrentEmployeeBankAcc)) {
                throw new AppException('Choose Different Account');
            }
        }

        $data['data']['country'] = $branch->country;
        if (!is_null($employeeBankDetail)) {
            return parent::update($data);
        } else {
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
