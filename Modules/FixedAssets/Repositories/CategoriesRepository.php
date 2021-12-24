<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaCategory;

class CategoriesRepository extends EloquentBaseRepository
{
    public $model = FxaCategory::class;

    public function getAll($params = [], $query = null)
    {
        if (!$query) {
            $query = FxaCategory::query();
        }
        if (isset($params['inputs']['is_parent'])) {
            $query->whereNull('parent_id');
        }
        return parent::getAll($params, $query);
    }

}
