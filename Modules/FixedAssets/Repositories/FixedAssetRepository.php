<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaAsset;

class FixedAssetRepository extends EloquentBaseRepository
{
    public $model = FxaAsset::class;
}
