<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\GradeLevelStep;

class GLStepsRepository extends EloquentBaseRepository
{
    public $model = GradeLevelStep::class;

}