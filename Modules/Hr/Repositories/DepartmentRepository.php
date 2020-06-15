<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Department;
use Modules\Hr\Models\EmployeeJobProfile;

class DepartmentRepository extends EloquentBaseRepository
{
    public $model = Department::class;

    public function getAll($params = [], $query = null)
    {

        $query = Department::with('sub_categories')->where('parent_id', null);
        return $query->get();
    }

    public function delete($data)
    {
        $data = EmployeeJobProfile::where('department_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
