<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\ReceiptVoucherRepository;

class ReceiptVoucherController extends BaseController
{
    protected $repository = ReceiptVoucherRepository::class;


    public function typePaymentVoucher(Request $request)
    {
        $this->jobMethod = "typePaymentVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
