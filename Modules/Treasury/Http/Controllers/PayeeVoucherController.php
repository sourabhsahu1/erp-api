<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\PayeeVoucherRepository;

class PayeeVoucherController extends BaseController
{

    protected $repository = PayeeVoucherRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";


    public function storePvAdvances(Request $request)
    {
        $this->jobMethod = "storePvAdvances";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

}
