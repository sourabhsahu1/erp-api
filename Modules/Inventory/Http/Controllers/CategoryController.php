<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;

use Modules\Inventory\Http\Requests\Category\Create;
use Modules\Inventory\Http\Requests\Category\Update;
use Modules\Inventory\Repositories\CategoryRepository;

class CategoryController extends BaseController
{
    protected $repository = CategoryRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;

}
