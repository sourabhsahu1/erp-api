<?php


namespace Modules\Hr\Repositories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeCensure;

class EmployeeCensureRepository extends EloquentBaseRepository
{
    public $model = EmployeeCensure::class;

    public function getAll($params = [], $query = null)
    {
        $query = EmployeeCensure::with([
            'censure',
            'issued_by',
            'employee',
            'file'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }

    public function create($data)
    {
        $data['data']['date_issued'] = Carbon::parse($data['data']['date_issued'])->toDateString();
        return parent::create($data);
    }

    public function update($data)
    {
        $data['data']['date_issued'] = Carbon::parse($data['data']['date_issued'])->toDateString();
        return parent::update($data);
    }

    public function show($id, $params = null)
    {
        $data = EmployeeCensure::with([
            'censure',
            'issued_by',
            'employee',
            'file'
        ])
            ->where('employee_id', $id['employeeId'])->where('id', $id['id'])->first();
        return $data;
    }
}
