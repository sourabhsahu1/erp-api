<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\GLSteps\GLStepsCreate;
use Modules\Hr\Http\Requests\GLSteps\GLStepsUpdate;
use Modules\Hr\Repositories\GLStepsRepository;

class GradeLevelStepController extends BaseController
{

    protected $repository = GLStepsRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeRequest = GLStepsCreate::class;
    protected $updateRequest = GLStepsUpdate::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
}