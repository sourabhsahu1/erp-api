<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Region;

class RegionRepository extends EloquentBaseRepository
{
    public $model = Region::class;
}