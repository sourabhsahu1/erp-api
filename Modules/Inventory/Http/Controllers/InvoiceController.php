<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Inventory\Repositories\InvoiceRepository;

class InvoiceController extends BaseController
{
    protected $repository = InvoiceRepository::class;

    public function srvPurchase(Request $request)
    {
        $this->jobMethod = "srvPurchase";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function srvReturn(Request $request)
    {
        $this->jobMethod = "srvReturn";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
    public function salesInwards(Request $request)
    {
        $this->jobMethod = "salesInwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function salesOutwards(Request $request)
    {
        $this->jobMethod = "salesOutwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeInwards(Request $request)
    {
        $this->jobMethod = "storeInwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeOutwards(Request $request)
    {
        $this->jobMethod = "storeOutwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function srvDonation(Request $request)
    {
        $this->jobMethod = "srvDonation";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeAdjustment(Request $request)
    {
        $this->jobMethod = "storeAdjustment";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeTransfer(Request $request)
    {
        $this->jobMethod = "storeTransfer";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
