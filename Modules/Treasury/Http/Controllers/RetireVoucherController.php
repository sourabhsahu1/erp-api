<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\RetireVoucherRepository;

class RetireVoucherController extends BaseController
{
    protected $repository = RetireVoucherRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";

    public function statusRetireVoucher(Request $request)
    {
        $this->jobMethod = "statusRetireVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function getLiabilities(Request $request)
    {
        $this->jobMethod = "getLiabilities";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function updateLiabilities(Request $request)
    {
        $this->jobMethod = "updateLiabilities";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function deleteLiability(Request $request)
    {
        $this->jobMethod = "deleteLiability";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }


    public function updateStatus(Request $request)
    {
        $this->jobMethod = "updateStatus";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function downloadRetireVoucherReport(Request $request)
    {
        $this->jobMethod = "downloadRetireVoucherReport";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
