<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaCategory;

class CategoriesRepository extends EloquentBaseRepository
{
    public $model = FxaCategory::class;

    public function create($data)
    {
        if (isset($data['data']['combined_code'])) {
            $data['data']['combined_code'] .= "\\" . $data['data']['individual_code'];
        } else {
            $data['data']['combined_code'] = $data['data']['individual_code'];
        }
        return parent::create($data);
    }

    public function getAll($params = [], $query = null)
    {
        if (!$query) {
            $query = FxaCategory::query();
        }
        if (isset($params['inputs']['is_parent'])) {
            $query->whereNull('parent_id');
            unset($params['inputs']['is_parent']);
        }
        return parent::getAll($params, $query);
    }

}
