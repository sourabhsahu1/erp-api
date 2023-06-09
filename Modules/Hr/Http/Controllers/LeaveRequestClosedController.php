<?php


namespace Modules\Hr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveRequestClosed\Create;
use Modules\Hr\Http\Requests\LeaveRequestClosed\Update;
use Modules\Hr\Repositories\LeaveRequestClosedRepository;

class LeaveRequestClosedController extends BaseController
{
    protected $indexWith = [
        'leave_request',
        'approved_hod_staff',
        'approved_hr_staff'
    ];
    protected $repository = LeaveRequestClosedRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
