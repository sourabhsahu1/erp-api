<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\JobPosition\Create;
use Modules\Hr\Http\Requests\JobPosition\Update;
use Modules\Hr\Repositories\JobPositionRepository;

class JobPositionController extends BaseController
{

    protected $repository = JobPositionRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
}