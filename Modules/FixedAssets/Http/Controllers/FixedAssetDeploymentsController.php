<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\FixedAssets\Repositories\FxaDeploymentRepository;

class FixedAssetDeploymentsController extends BaseController
{
    protected $repository = FxaDeploymentRepository::class;
    protected $indexWith = ['admin_segment', 'work_location', 'custodian'];
    protected $storeJobMethod = "create";
    protected $createJob = BaseJob::class;
}
