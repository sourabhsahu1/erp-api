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
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";


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
}
