<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\Category;
use Modules\Inventory\Models\Item;

class CategoryRepository extends EloquentBaseRepository
{
    public $model = Category::class;


    public function getAll($params = [], $query = null)
    {
        $query = Category::with('sub_categories')->where('parent_id', null);
        return $query->get();
    }


    public function delete($data)
    {
        $itemData = Item::where('category_id', $data['id'])->first();

        if (is_null($itemData)) {
            return parent::delete($data);
        } else {
            throw new AppException('Already in use');
        }


    }
}
