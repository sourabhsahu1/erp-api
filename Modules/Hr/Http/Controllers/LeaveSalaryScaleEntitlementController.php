<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveSalaryScaleEntitlement\Create;
use Modules\Hr\Http\Requests\LeaveSalaryScaleEntitlement\Update;
use Modules\Hr\Repositories\LeaveSalaryScaleEntitlementRepository;

class LeaveSalaryScaleEntitlementController extends BaseController
{
    protected $indexWith = [
        'salary_scale',
        'leave',
        ];
    protected $repository = LeaveSalaryScaleEntitlementRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}