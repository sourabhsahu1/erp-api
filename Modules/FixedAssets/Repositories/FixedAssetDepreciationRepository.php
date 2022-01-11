<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaDeprecationMethod;

class FixedAssetDepreciationRepository extends EloquentBaseRepository
{
    public $model = FxaDeprecationMethod::class;
}
