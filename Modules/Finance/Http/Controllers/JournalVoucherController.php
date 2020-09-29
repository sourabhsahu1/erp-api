<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Http\Requests\JournalVoucher\Create;
use Modules\Finance\Http\Requests\JournalVoucher\Update;
use Modules\Finance\Repositories\JournalVoucherRepository;

class JournalVoucherController extends BaseController
{
    protected $repository = JournalVoucherRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $indexWith = ['journal_voucher_details'];
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    public function updateStatus(Request $request)
    {
        $this->jobMethod = "updateStatus";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
