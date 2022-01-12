<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaDeployment;
use Modules\FixedAssets\Entities\FxaDeprecationMethod;

class FxaDeploymentRepository extends EloquentBaseRepository
{
    public $model = FxaDeployment::class;
}
