<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\ReceiptPayeeRepository;

class ReceiptPayeeController extends BaseController
{

    protected $repository = ReceiptPayeeRepository::class;
    protected $createJob = BaseJob::class;
    protected $storeJobMethod = "create";
}
