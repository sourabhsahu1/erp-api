<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaAsset;
use Modules\FixedAssets\Entities\FxaStatus;

class FixedAssetStatusRepository extends EloquentBaseRepository
{
    public $model = FxaStatus::class;
}
