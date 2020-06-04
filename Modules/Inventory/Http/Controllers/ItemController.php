<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Inventory\Http\Requests\Items\Create;
use Modules\Inventory\Http\Requests\Items\Update;
use Modules\Inventory\Repositories\ItemRepository;

class ItemController extends BaseController
{
    protected $repository = ItemRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}

