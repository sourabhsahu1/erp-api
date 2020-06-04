<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\Measurement;

class MeasurementRepository extends EloquentBaseRepository
{
    public $model = Measurement::class;
}
