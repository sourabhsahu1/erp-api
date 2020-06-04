<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\Item;

class ItemRepository extends EloquentBaseRepository
{
    public $model = Item::class;
}
