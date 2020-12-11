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
}
