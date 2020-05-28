<?php


namespace Modules\Hr\Repositories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeEmploymentHistory;

class EmploymentHistoryRepository extends EloquentBaseRepository
{

    public $model = EmployeeEmploymentHistory::class;
    public function getAll($params = [], $query = null)
    {
        $query = EmployeeEmploymentHistory::with([
            'employee'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }


    public function create($data)
    {
        $data['data']['engaged'] = Carbon::parse($data['data']['engaged'])->toDateString();
        $data['data']['disengaged'] = Carbon::parse($data['data']['disengaged'])->toDateString();
        return parent::create($data);
    }


    public function update($data)
    {
        $data['data']['engaged'] = Carbon::parse($data['data']['engaged'])->toDateString();
        $data['data']['disengaged'] = Carbon::parse($data['data']['disengaged'])->toDateString();
        return parent::update($data);
    }
}
