<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Repositories\BankBranchRepository;
use Modules\Inventory\Http\Requests\Invoices\SrvPurchaseRequest;

class BankBranchesController extends BaseController
{
    protected $repository = BankBranchRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
//    protected $storeRequest = Create::class;
//    protected $updateRequest = Update::class;
    public function destroy(Request $request, $id)
    {
        $this->jobMethod = "delete";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }


}
