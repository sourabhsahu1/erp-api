<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\ScheduleEconomicsRepository;

class ScheduleEconomicsController extends BaseController
{

    protected $repository = ScheduleEconomicsRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
//    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
//    protected $deleteJobMethod = "delete";

    function getPaymentVoucherScheduleEconomic(Request $request) {
        $this->jobMethod = 'getPaymentVoucherScheduleEconomic';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function destroy(Request $request, $id)
    {
        $this->customMessage = "Resource deleted successfully";
        $this->jobMethod = "delete";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
