<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\ArmOfService;
use Modules\Hr\Models\EmployeeMilitaryService;

class ArmOfServiceRepository extends EloquentBaseRepository
{
    public $model = ArmOfService::class;

    public function delete($data)
    {
        $data = EmployeeMilitaryService::where('arm_of_service_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
