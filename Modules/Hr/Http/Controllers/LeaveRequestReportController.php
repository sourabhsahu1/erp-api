<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Repositories\LeaveRequestReportRepository;

class LeaveRequestReportController extends BaseController
{
    protected $indexWith = [
        'leave',
        'LeaveCredit',
        'staff',
    ];
    public $filterable = [
        'approved_HOD',
        'approved_HR',
    ];
    protected $repository = LeaveRequestReportRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}