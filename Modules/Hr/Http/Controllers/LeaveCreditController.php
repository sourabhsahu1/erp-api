<?php


namespace Modules\Hr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveCredit\Create;
use Modules\Hr\Http\Requests\LeaveCredit\Update;
use Modules\Hr\Repositories\LeaveCreditRepository;

class LeaveCreditController extends BaseController
{
    protected $indexWith = [
        'leave',
        'employee',
        'leave_year',
    ];
    protected $repository = LeaveCreditRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;

    public function LeaveCreditView(Request $request)
    {
        $this->jobMethod = "leaveCreditView";
        $data = DB::table('viewStaffLeaveEntitlement')->get();
        return $this->standardResponse($data,200);
    }
}
