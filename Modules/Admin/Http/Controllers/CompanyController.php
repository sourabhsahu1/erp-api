<?php


namespace Modules\Admin\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Http\Requests\Company\Create;
use Modules\Admin\Http\Requests\Company\Update;
use Modules\Admin\Repositories\CompanyRepository;

class CompanyController extends BaseController
{

    protected $repository = CompanyRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $indexWith = ['company_banks'];
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
