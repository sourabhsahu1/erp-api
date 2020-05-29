<?php


namespace Modules\Hr\Repositories;


use Illuminate\Http\Request;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeAddress;

class EmployeeAddressRepository extends EloquentBaseRepository
{
    public $model = EmployeeAddress::class;

    public function create($data)
    {
        $data['data']['address_line_1'] = $data['data']['address_line1'];
        $data['data']['address_line_2'] = $data['data']['address_line2'] ?? null;
        return parent::create($data);
    }


    public function update($data)
    {
        $data['data']['address_line_1'] = $data['data']['address_line1'];
        $data['data']['address_line_2'] = $data['data']['address_line2'] ?? null;
        return parent::update($data);
    }

    public function getAll($params = [], $query = null)
    {
        $query = EmployeeAddress::with([
            'address_type',
            'country',
            'employee',
            'lga',
            'region',
            'state'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }

    public function show($id, $params = null)
    {
        $data = EmployeeAddress::with([
            'address_type',
            'country',
            'employee',
            'lga',
            'region',
            'state'
        ])
            ->where('employee_id', $id['employeeId'])->where('id', $id['id'])->first();
        return $data;
    }
}
