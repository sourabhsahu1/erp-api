<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\FixedAssets\Http\Requests\FixedAssets\Create;
use Modules\FixedAssets\Http\Requests\FixedAssets\Update;
use Modules\FixedAssets\Repositories\FixedAssetRepository;

class FixedAssetsController extends BaseController
{
    protected $repository = FixedAssetRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $showWith = ['program_segment', 'economic_segment', 'functional_segment', 'geo_code_segment', 'admin_segment', 'fund_segment', 'latest_deployment', 'latest_deployment.admin_segment', 'latest_deployment.work_location', 'latest_deployment.custodian'];
    protected $indexWith = ['latest_deployment', 'latest_deployment.admin_segment', 'latest_deployment.work_location', 'latest_deployment.custodian'];
}
