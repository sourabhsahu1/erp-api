<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Academic;

class AcademicsRepository extends EloquentBaseRepository
{
    public $model = Academic::class;
}