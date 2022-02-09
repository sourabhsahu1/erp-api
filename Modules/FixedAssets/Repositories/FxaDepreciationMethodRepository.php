<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaDepreciationMethod;

class FxaDepreciationMethodRepository extends EloquentBaseRepository
{
    public $model = FxaDepreciationMethod::class;
}
