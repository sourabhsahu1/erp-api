<?php

namespace Modules\FixedAssets\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\FixedAssets\Repositories\FixedAssetRepository;

class FixedAssetsController extends Controller
{
    protected $repository = FixedAssetRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
}
