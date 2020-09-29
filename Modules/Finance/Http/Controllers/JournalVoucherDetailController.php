<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Repositories\JournalVoucherDetailRepository;

class JournalVoucherDetailController extends BaseController
{
    protected $repository = JournalVoucherDetailRepository::class;
    protected $updateJob = BaseJob::class;
    protected $updateJobMethod = "update";


    public function destroy(Request $request, $id)
    {
        $this->jobMethod = "delete";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function show(Request $request, $id)
    {
        $this->jobMethod = "show";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
