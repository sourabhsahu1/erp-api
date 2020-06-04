<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\Store;

class StoreRepository extends EloquentBaseRepository
{

    public $model = Store::class;
}
