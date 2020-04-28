<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\ArmOfService;

class ArmOfServiceRepository extends EloquentBaseRepository
{


    public $model = ArmOfService::class;
}