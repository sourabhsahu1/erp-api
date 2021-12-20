<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaDepreciation;

class FixedAssetDepreciationRepository extends EloquentBaseRepository
{
    public $model = FxaDepreciation::class;
}
