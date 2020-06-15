<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeQualification;
use Modules\Hr\Models\Qualification;

class QualificationRepository extends EloquentBaseRepository
{

    public $model = Qualification::class;

    public function delete($data)
    {
        $data = EmployeeQualification::where('qualification_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
