<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Repositories\EmployeeMilitaryRepository;

class EmployeeMilitaryServiceController extends BaseController
{
    protected $repository = EmployeeMilitaryRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
}
