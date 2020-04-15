<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Qualification;

class QualificationRepository extends EloquentBaseRepository
{

    public $model = Qualification::class;
}