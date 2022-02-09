<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\FixedAssets\Repositories\FxaDepreciationMethodRepository;

class FixAssetDepreciationController extends BaseController
{
    protected $repository = FxaDepreciationMethodRepository::class;
    protected $storeJobMethod = "create";
    protected $createJob = BaseJob::class;
}
