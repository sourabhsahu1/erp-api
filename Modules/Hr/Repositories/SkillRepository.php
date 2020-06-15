<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\JobPosition;
use Modules\Hr\Models\Skill;

class SkillRepository extends EloquentBaseRepository
{

    public $model = Skill::class;

    public function delete($data)
    {
        $data = JobPosition::where('skill_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}
