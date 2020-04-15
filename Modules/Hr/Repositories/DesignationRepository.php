<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Designation;

class DesignationRepository extends EloquentBaseRepository
{

    public $model = Designation::class;
}