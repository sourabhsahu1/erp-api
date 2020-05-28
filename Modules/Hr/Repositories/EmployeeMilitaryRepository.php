<?php


namespace Modules\Hr\Repositories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeMilitaryService;

class EmployeeMilitaryRepository extends EloquentBaseRepository
{

    public $model = EmployeeMilitaryService::class;

    public function getAll($params = [], $query = null)
    {
        $query = EmployeeMilitaryService::with([
            'arm_of_service',
            'employee'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }

    public function create($data)
    {
        $data['data']['engaged_at'] = Carbon::parse($data['data']['engaged_at'])->toDateString();
        $data['data']['discharged_at'] = Carbon::parse($data['data']['discharged_at'])->toDateString();
        return parent::create($data);
    }

    public function update($data)
    {
        $data['data']['engaged_at'] = Carbon::parse($data['data']['engaged_at'])->toDateString();
        $data['data']['discharged_at'] = Carbon::parse($data['data']['discharged_at'])->toDateString();
        return parent::update($data);
    }
}
