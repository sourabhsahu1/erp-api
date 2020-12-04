<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Http\Requests\Budget\Create;
use Modules\Finance\Http\Requests\Budget\Update;
use Modules\Finance\Repositories\BudgetRepository;

class BudgetController extends BaseController
{
    protected $repository = BudgetRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $indexWith = ['admin_segment', 'economic_segment', 'program_segment', 'fund_segment', 'currency', 'budget_breakups'];

    public function getEconomicBudget(Request $request)
    {
        $this->jobMethod = "getEconomicBudget";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
