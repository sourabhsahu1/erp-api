<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\ReceiptPayeeRepository;

class ReceiptPayeeController extends BaseController
{

    protected $repository = ReceiptPayeeRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
//    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";

//    protected $deleteJobMethod = "delete";

    public function destroy(Request $request, $id)
    {
        $this->jobMethod = "delete";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
