<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\FixedAssets\Repositories\FxaDepreciationDetailRepository;
use Modules\FixedAssets\Repositories\FxaDepreciationMethodRepository;

class FixAssetDepreciationController extends BaseController
{
    protected $repository = FxaDepreciationDetailRepository::class;
    protected $storeJobMethod = "create";
    protected $createJob = BaseJob::class;
}
