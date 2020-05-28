<?php


namespace Modules\Hr\Repositories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeSchool;

class EmployeeSchoolRepository extends EloquentBaseRepository
{

    public $model = EmployeeSchool::class;
    public function getAll($params = [], $query = null)
    {
        $query = EmployeeSchool::with([
            'country',
            'employee',
            'schedule'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }


    public function create($data)
    {
        $data['data']['entered_at'] = Carbon::parse($data['data']['entered_at'])->toDateString();
        $data['data']['exited_at'] = Carbon::parse($data['data']['exited_at'])->toDateString();
        return parent::create($data);
    }


    public function update($data)
    {
        $data['data']['entered_at'] = Carbon::parse($data['data']['entered_at'])->toDateString();
        $data['data']['exited_at'] = Carbon::parse($data['data']['exited_at'])->toDateString();
        return parent::update($data);
    }
}
