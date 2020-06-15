<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Designation;
use Modules\Hr\Models\JobPosition;

class DesignationRepository extends EloquentBaseRepository
{

    public $model = Designation::class;

    public function delete($data)
    {
        $data = JobPosition::where('designation_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
