<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeSchool;
use Modules\Hr\Models\Schedule;

class ScheduleRepository extends EloquentBaseRepository
{

    public $model = Schedule::class;

    public function delete($data)
    {
        $employeeSchool = EmployeeSchool::where('schedule_id', $data['id'])->first();
        if (is_null($employeeSchool)) {
            return parent::delete($data);
        } else {
            throw new AppException('Already in use');
        }
    }

    public function getAll($params = [], $query = null)
    {

        if (isset($params["inputs"]["orderby"])) {
            $params["inputs"]["orderby"] = 'name';
            $params['inputs']['order'] = 'asc';
        }

        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }
}
