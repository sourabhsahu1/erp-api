<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Http\Requests\CreateCurrenyRequest;
use Modules\Finance\Http\Requests\UpdateCurrencyRequest;
use Modules\Finance\Repositories\CurrencyRepository;

class CurrencyController extends BaseController
{
    protected $repository = CurrencyRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";

    protected $storeRequest = CreateCurrenyRequest::class;
    protected $updateRequest = UpdateCurrencyRequest::class;
}
