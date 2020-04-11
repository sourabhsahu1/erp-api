<?php


namespace Modules\Hr\Repositories;


use App\User;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;

class SomeRepository extends EloquentBaseRepository
{

    public $model = User::class;

}
