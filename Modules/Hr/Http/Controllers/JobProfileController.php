<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\JobProfile\Create;
use Modules\Hr\Http\Requests\JobProfile\Update;
use Modules\Hr\Repositories\JobProfileRepository;

class JobProfileController extends BaseController
{
    protected $indexWith = [
        'hr_employee',
        'job_position',
        'department',
        'designation',
        ];
    protected $repository = JobProfileRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}