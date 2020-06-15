<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeJobProfile;
use Modules\Hr\Models\WorkLocation;

class WorkLocationRepository extends EloquentBaseRepository
{

    public $model = WorkLocation::class;

    public function getAll($params = [], $query = null)
    {
        $query = WorkLocation::with('sub_categories')->where('parent_id', null);
        return $query->get();
    }

    public function delete($data)
    {
        $data = EmployeeJobProfile::where('work_location_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
