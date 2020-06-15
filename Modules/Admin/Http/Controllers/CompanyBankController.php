<?php


namespace Modules\Admin\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Http\Requests\CompanyBank\Create;
use Modules\Admin\Http\Requests\CompanyBank\Update;
use Modules\Admin\Repositories\CompanyBankRepository;

class CompanyBankController extends BaseController
{
    protected $repository = CompanyBankRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
