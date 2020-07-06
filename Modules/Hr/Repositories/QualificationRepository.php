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
        $qualification = EmployeeQualification::where('qualification_id', $data['id'])->first();
        if (is_null($qualification)) {
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
