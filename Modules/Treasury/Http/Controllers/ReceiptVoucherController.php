<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\ReceiptVoucherRepository;

class ReceiptVoucherController extends BaseController
{
    protected $repository = ReceiptVoucherRepository::class;
    protected $createJob = BaseJob::class;
    protected $storeJobMethod = "create";

    protected $indexWith = [
        'program_segment',
        'economic_segment',
        'functional_segment',
        'geo_code_segment',
        'admin_segment',
        'fund_segment',
        'employee',
        'receipt_payees',
        'receipt_schedule_economic',
        'voucher_source_unit',
        'total_amount'
    ];
    public function typePaymentVoucher(Request $request)
    {
        $this->jobMethod = "typePaymentVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function updateStatus(Request $request)
    {
        $this->jobMethod = "updateStatus";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function statusReceiptVoucher(Request $request)
    {
        $this->jobMethod = "statusReceiptVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
