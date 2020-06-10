<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Inventory\Repositories\InvoiceRepository;

class InvoiceController extends BaseController
{
    protected $repository = InvoiceRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";


    public function srvPurchase(Request $request)
    {
        $this->jobMethod = "srvPurchase";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
