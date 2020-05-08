<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\Academics\Create;
use Modules\Hr\Http\Requests\Academics\Update;
use Modules\Hr\Repositories\AcademicsRepository;

class AcademicsController extends BaseController
{

    protected $repository = AcademicsRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}