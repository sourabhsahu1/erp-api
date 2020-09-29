<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Repositories\JournalVoucherRepository;

class JournalVoucherController extends BaseController
{
    protected $repository = JournalVoucherRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $indexWith = ['journal_voucher_details'];

    public function updateStatus(Request $request)
    {
        $this->jobMethod = "updateStatus";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
