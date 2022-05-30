<?php


namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveRequest\Create;
use Modules\Hr\Http\Requests\LeaveRequest\Update;
use Modules\Hr\Repositories\LeaveRequestRepository;

class LeaveRequestController extends BaseController
{
    protected $indexWith = [
        'staff',
        'relief_officer',
        'approved_hod_staff',
        'approved_hr_staff'
    ];
    protected $repository = LeaveRequestRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
