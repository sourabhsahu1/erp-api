<?php


namespace Modules\Finance\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Finance\Http\Requests\JournalVoucherDetail\Create;
use Modules\Finance\Http\Requests\JournalVoucherDetail\Delete;
use Modules\Finance\Http\Requests\JournalVoucherDetail\Update;
use Modules\Finance\Repositories\JournalVoucherDetailRepository;

class JournalVoucherDetailController extends BaseController
{
    protected $repository = JournalVoucherDetailRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
//    protected $storeRequest = Create::class;
//    protected $updateRequest = Update::class;
    protected $deleteRequest = Delete::class;

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
