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
        $data = EmployeeSchool::where('schedule_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
