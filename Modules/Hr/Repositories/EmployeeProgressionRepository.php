<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeJobProfile;
use Modules\Hr\Models\EmployeeProgressionHistory;

class EmployeeProgressionRepository extends EloquentBaseRepository
{

    public $model = EmployeeProgressionHistory::class;


    public function create($data)
    {

        EmployeeProgressionHistory::where('employee_id', $data['data']['employee_id'])->update(['is_active' => false]);
        $history = parent::create($data);
        unset($data['data']['value_date']);
        unset($data['data']['user_id']);
        $this->model = EmployeeJobProfile::class;
        $empProgression = EmployeeJobProfile::where('employee_id', $data['data']['employee_id'])->update($data['data']);

        return $history;
    }

    public function update($data)
    {

        /** @var EmployeeProgressionHistory $progressionHistory */
        $progressionHistory = EmployeeProgressionHistory::find($data['id']);

        if ($progressionHistory->is_active === true) {
            $history = parent::update($data);
        }
        unset($data['data']['value_date']);
        unset($data['data']['user_id']);
        $empProgression = EmployeeJobProfile::where('employee_id', $data['data']['employee_id'])->update($data['data']);

        return EmployeeProgressionHistory::find($data['id']);
    }
}
