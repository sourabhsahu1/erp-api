<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\GradeLevel;
use Modules\Hr\Models\GradeLevelStep;

class GradeLevelRepository extends EloquentBaseRepository
{
    public $model = GradeLevel::class;
    public function getAll($params = [], $query = null)
    {

        if (isset($params["inputs"]["orderby"])) {
            $params["inputs"]["orderby"] = 'name';
            $params['inputs']['order'] = 'asc';
        }

        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }
    public function delete($data)
    {
        $grade = GradeLevelStep::where('grade_level_id', $data['id'])->first();
        if (is_null($grade)) {
            return parent::delete($data);
        } else {
            throw new AppException('Already in use');
        }
    }
}
