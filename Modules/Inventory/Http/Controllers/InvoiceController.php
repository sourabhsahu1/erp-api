<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Inventory\Http\Requests\Invoices\Donation;
use Modules\Inventory\Http\Requests\Invoices\SaleInward;
use Modules\Inventory\Http\Requests\Invoices\SaleOutwards;
use Modules\Inventory\Http\Requests\Invoices\SrvPurchaseRequest;
use Modules\Inventory\Http\Requests\Invoices\SrvReturnRequest;
use Modules\Inventory\Http\Requests\Invoices\StoreAdjustment;
use Modules\Inventory\Http\Requests\Invoices\StoreInwards;
use Modules\Inventory\Http\Requests\Invoices\StoreOutwards;
use Modules\Inventory\Http\Requests\Invoices\StoreTransfer;
use Modules\Inventory\Repositories\InvoiceRepository;

class InvoiceController extends BaseController
{
    protected $repository = InvoiceRepository::class;
    protected $indexWith = ['invoice_items.lifo'];

    public function srvPurchase(Request $request)
    {
        $this->jobMethod = "srvPurchase";
        $this->customRequest = SrvPurchaseRequest::class;
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function srvReturn(Request $request)
    {
        $this->jobMethod = "srvReturn";
        $this->customRequest = SrvReturnRequest::class;
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
    public function salesInwards(Request $request)
    {
        $this->customRequest = SaleInward::class;
        $this->jobMethod = "salesInwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function salesOutwards(Request $request)
    {
        $this->customRequest = SaleOutwards::class;
        $this->jobMethod = "salesOutwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeInwards(Request $request)
    {
        $this->customRequest = StoreInwards::class;
        $this->jobMethod = "storeInwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeOutwards(Request $request)
    {
        $this->customRequest = StoreOutwards::class;
        $this->jobMethod = "storeOutwards";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function srvDonation(Request $request)
    {
        $this->customRequest = Donation::class;
        $this->jobMethod = "srvDonation";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeAdjustment(Request $request)
    {

        $this->customRequest = StoreAdjustment::class;
        $this->jobMethod = "storeAdjustment";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function storeTransfer(Request $request)
    {

        $this->customRequest= StoreTransfer::class;
        $this->jobMethod = "storeTransfer";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function inventoryLedgerReport(Request $request)
    {
        $this->jobMethod = "inventoryLedgerReport";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function inventoryQualityBalance(Request $request)
    {
        $this->jobMethod = "inventoryQualityBalance";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function binCardReport(Request $request)
    {
        $this->jobMethod = "binCardReport";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function offLevelReport(Request $request){
        $this->jobMethod = "offLevelReport";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function getLifoData(Request $request){
        $this->jobMethod = "getLifoData";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

}
