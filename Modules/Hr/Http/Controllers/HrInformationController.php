<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\HrInformation\Create;
use Modules\Hr\Http\Requests\HrInformation\Update;
use Modules\Hr\Repositories\HrInformationRepository;

class HrInformationController extends BaseController
{
    protected $indexWith = [
        'leave_year',
        ];
    protected $repository = HrInformationRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}