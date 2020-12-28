<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\ReportRepository;

class ReportController extends BaseController
{

    protected $repository = ReportRepository::class;

    public function summaryNonPersonalAdvances(Request $request)
    {
        $this->jobMethod = "summaryNonPersonalAdvances";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function summaryPersonalAdvances(Request $request)
    {
        $this->jobMethod = "summaryPersonalAdvances";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function summarySpecialImprest(Request $request)
    {
        $this->jobMethod = "summarySpecialImprest";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function summaryStandingImprest(Request $request)
    {
        $this->jobMethod = "summaryStandingImprest";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function downloadReportPv(Request $request)
    {
        $this->jobMethod = "downloadReportPv";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function downloadReportRv(Request $request)
    {
        $this->jobMethod = "downloadReportRv";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }


    public function advanceLedger(Request $request)
    {
        $this->jobMethod = "advanceLedger";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

}
