<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\ReceiptScheduleEconomicRepository;

class ReceiptScheduleEconomicController extends BaseController
{
    protected $repository = ReceiptScheduleEconomicRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";

    function getReceiptVoucherScheduleEconomic(Request $request)
    {
        $this->jobMethod = 'getReceiptVoucherScheduleEconomic';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    protected $indexWith = [
        'economic_segment',
        'receipt_payee',
        'receipt_voucher'
    ];
}
