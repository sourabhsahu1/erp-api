<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\Category;

class CategoryRepository extends EloquentBaseRepository
{
    public $model = Category::class;


    public function getAll($params = [], $query = null)
    {
        $query = Category::with('sub_categories')->where('parent_id', null);
        return $query->get();
    }
}
