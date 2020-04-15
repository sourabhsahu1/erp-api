<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Skill;

class SkillRepository extends EloquentBaseRepository
{

    public $model = Skill::class;
}