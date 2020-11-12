<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\CashbookRepository;

class CashbookController extends BaseController
{
    protected $repository = CashbookRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $indexWith = ['cashbook_monthly_balances'];


    public function getCashbookTypes(Request $request)
    {
        $this->jobMethod = 'getCashbookTypes';
        $this->indexWith = [];
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
