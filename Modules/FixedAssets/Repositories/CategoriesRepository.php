<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaCategory;

class CategoriesRepository extends EloquentBaseRepository
{
    public $model = FxaCategory::class;

}
