<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Academic;
use Modules\Hr\Models\EmployeeQualification;

class AcademicsRepository extends EloquentBaseRepository
{
    public $model = Academic::class;

    public function delete($data)
    {
        $data = EmployeeQualification::where('academic_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
