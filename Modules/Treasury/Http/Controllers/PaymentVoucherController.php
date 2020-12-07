<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\PaymentRepository;

class PaymentVoucherController extends BaseController
{

    protected $repository = PaymentRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $indexWith = [
        'program_segment',
        'economic_segment',
        'functional_segment',
        'geo_code_segment',
        'admin_segment',
        'fund_segment',
        'aie',
        'employee',
        'currency',
        'voucher_source_unit',
        'total_amount',
        'total_tax'
    ];



    public function updateStatus(Request $request)
    {
        $this->jobMethod = "updateStatus";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function typePaymentVoucher(Request $request)
    {
        $this->jobMethod = "typePaymentVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }


    public function statusPaymentVoucher(Request $request)
    {
        $this->jobMethod = "statusPaymentVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
