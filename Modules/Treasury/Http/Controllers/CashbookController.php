<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Http\Requests\Cashbook\Create;
use Modules\Treasury\Http\Requests\Cashbook\Update;
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
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $indexWith = [
        'cashbook_monthly_balances',
        'bank_branch',
        'bank',
        'currency',
        'economic_segment',
        'fund_owned'
    ];


    public function getCashbookTypes(Request $request)
    {
        $this->jobMethod = 'getCashbookTypes';
        $this->indexWith = [];
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
