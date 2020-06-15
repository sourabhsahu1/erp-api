<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\GradeLevel;
use Modules\Hr\Models\GradeLevelStep;

class GradeLevelRepository extends EloquentBaseRepository
{
    public $model = GradeLevel::class;

    public function delete($data)
    {
        $data = GradeLevelStep::where('grade_level_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
