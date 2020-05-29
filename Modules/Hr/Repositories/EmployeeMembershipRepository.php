<?php


namespace Modules\Hr\Repositories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeMembership;

class EmployeeMembershipRepository extends EloquentBaseRepository
{

    public $model  = EmployeeMembership::class;

    public function getAll($params = [], $query = null)
    {
        $query = EmployeeMembership::with([
            'membership',
            'employee'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }


    public function create($data)
    {
        $data['data']['join_at'] = Carbon::parse($data['data']['join_at'])->toDateString();
        return parent::create($data);
    }

    public function update($data)
    {
        $data['data']['join_at'] = Carbon::parse($data['data']['join_at'])->toDateString();
        return parent::update($data);
    }

    public function show($id, $params = null)
    {
        $data = EmployeeMembership::with([
            'membership',
            'employee'
        ])
            ->where('employee_id', $id['employeeId'])->where('id', $id['id'])->first();
        return $data;
    }
}
