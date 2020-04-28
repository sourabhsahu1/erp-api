<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Status;

class StatusRepository extends EloquentBaseRepository
{

    public $model = Status::class;
}