<?php


namespace Modules\Hr\Repositories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeRelation;

class EmployeeRelationRepository extends EloquentBaseRepository
{

    public $model = EmployeeRelation::class;
    public function getAll($params = [], $query = null)
    {
        $query = EmployeeRelation::with([
            'employee',
            'country',
            'region',
            'state',
            'lga',
            'relationship'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }


    public function create($data)
    {
        $data['data']['date_of_birth'] = Carbon::parse($data['data']['date_of_birth'])->toDateString();
        $data['data']['address_line_1'] = $data['data']['address_line1'];
        $data['data']['address_line_2'] = $data['data']['address_line2'] ?? null;
        return parent::create($data);
    }


    public function update($data)
    {
        $data['data']['date_of_birth'] = Carbon::parse($data['data']['date_of_birth'])->toDateString();
        $data['data']['address_line_1'] = $data['data']['address_line1'];
        $data['data']['address_line_2'] = $data['data']['address_line2'] ?? null;
        return parent::update($data);
    }

    public function show($id, $params = null)
    {
        $data = EmployeeRelation::with([
            'employee',
            'country',
            'region',
            'state',
            'lga',
            'relationship'
        ])
            ->where('employee_id', $id['employeeId'])->where('id', $id['id'])->first();
        return $data;
    }
}
