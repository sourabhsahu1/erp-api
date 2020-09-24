<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Repositories\BankRepository;

class BankController extends BaseController
{

    protected $repository = BankRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
//    protected $storeRequest = Create::class;
//    protected $updateRequest = Update::class;
}
