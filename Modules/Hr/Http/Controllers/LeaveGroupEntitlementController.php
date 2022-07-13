<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveGroupEntitlement\Create;
use Modules\Hr\Http\Requests\LeaveGroupEntitlement\Update;
use Modules\Hr\Repositories\LeaveGroupEntitlementRepository;

class LeaveGroupEntitlementController extends BaseController
{
    protected $indexWith = [
        'leave',
        'leave_group',
        ];
    protected $repository = LeaveGroupEntitlementRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}