<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Lga;

class LgaRepository extends EloquentBaseRepository
{

    public $model = Lga::class;
}