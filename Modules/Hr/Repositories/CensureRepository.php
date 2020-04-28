<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Censure;

class CensureRepository extends EloquentBaseRepository
{

    public $model = Censure::class;
}