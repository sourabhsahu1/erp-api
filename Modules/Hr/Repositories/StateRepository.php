<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\State;

class StateRepository extends EloquentBaseRepository
{

    public $model = State::class;
}