<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\GradeLevelStep;
use Modules\Hr\Models\JobPosition;

class GLStepsRepository extends EloquentBaseRepository
{
    public $model = GradeLevelStep::class;

    public function delete($data)
    {
        $jobPosition = JobPosition::where('grade_level_step_id', $data['id'])->first();
        if (is_null($jobPosition)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }

}
