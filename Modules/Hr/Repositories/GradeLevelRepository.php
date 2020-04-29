<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\GradeLevel;

class GradeLevelRepository extends EloquentBaseRepository
{
    public $model = GradeLevel::class;
}