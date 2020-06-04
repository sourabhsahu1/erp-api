<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Inventory\Http\Requests\Store\Create;
use Modules\Inventory\Http\Requests\Store\Update;
use Modules\Inventory\Repositories\StoreRepository;

class StoreController extends BaseController
{
    protected $repository = StoreRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
