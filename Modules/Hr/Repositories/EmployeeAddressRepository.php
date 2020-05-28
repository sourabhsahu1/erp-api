<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeAddress;

class EmployeeAddressRepository extends EloquentBaseRepository
{
    public $model = EmployeeAddress::class;

    public function create($data)
    {
        $data['data']['employee_id'] = $data['data']['id'];
        return parent::create($data);
    }


    public function update($data)
    {
        $data['data']['employee_id'] = $data['data']['id'];
        return parent::update($data);
    }

    public function getAll($params = [], $query = null)
    {
        $query = EmployeeAddress::where('employee_id', $params['inputs']['id']);
        return parent::getAll($params, $query);
    }

    public function delete($data)
    {
        dd($data);
        $data['id'] = $data[''];
        return parent::delete($data); // TODO: Change the autogenerated stub
    }
}
