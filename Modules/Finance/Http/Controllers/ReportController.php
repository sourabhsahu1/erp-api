<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Repositories\ReportRepository;

class ReportController extends BaseController
{
    protected $repository = ReportRepository::class;

    public function getTrialBalanceReport(Request $request) {
        $this->jobMethod = "getTrialBalanceReport";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function getJvLedgerReport(Request $request)
    {
        $this->jobMethod = 'getJvLedgerReport';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function addNotes(Request $request) {
        $this->jobMethod = 'addNotes';
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function getNotesTrialBalanceReport(Request $request) {
        $this->jobMethod = 'getNotesTrialBalanceReport';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

}
