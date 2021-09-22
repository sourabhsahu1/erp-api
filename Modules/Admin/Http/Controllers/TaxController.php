<?php


namespace Modules\Admin\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Http\Requests\Tax\Create;
use Modules\Admin\Http\Requests\Tax\Update;
use Modules\Admin\Repositories\TaxRepository;

class TaxController extends BaseController
{
    protected $repository = TaxRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $indexWith = ['company', 'admin_segment'];
}
