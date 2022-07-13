<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveGradeLevelEntitlement\Create;
use Modules\Hr\Http\Requests\LeaveGradeLevelEntitlement\Update;
use Modules\Hr\Repositories\LeaveGradeLevelEntitlementRepository;

class LeaveGradeLevelEntitlementController extends BaseController
{
    protected $indexWith = [
        'leave',
        'grade_level',
        ];
    protected $repository = LeaveGradeLevelEntitlementRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}