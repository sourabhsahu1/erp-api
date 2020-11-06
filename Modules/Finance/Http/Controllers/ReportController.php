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
    public function getSiblingReport(Request $request) {
        $this->jobMethod = 'getSiblingReport';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function getMonthlyActivity(Request $request) {
        $this->jobMethod = 'getMonthlyActivity';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function getStatementOfPosition(Request $request) {
        $this->jobMethod = 'getStatementOfPosition';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function getFinancialPerformance(Request $request) {
        $this->jobMethod = 'getFinancialPerformance';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function deleteNotes(Request $request) {
        $this->jobMethod = 'deleteNotes';
        $this->customMessage = "table truncated successfully";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

}
