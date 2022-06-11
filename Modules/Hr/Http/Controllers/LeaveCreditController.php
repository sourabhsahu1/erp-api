<?php


namespace Modules\Hr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveCredit\Create;
use Modules\Hr\Http\Requests\LeaveCredit\Update;
use Modules\Hr\Models\LeaveCredit;
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
        return $this->standardResponse($data, 200);
    }

    public function BulkUpload(Request $request)
    {
        $data = $request->all();
        $finalArray = array();
        foreach ($data as $key => $value) {
            array_push(
                $finalArray,
                array(
                    'prepared_login_id' => $value['preparedLoginId'],
                    'staff_id' => $value['staffId'],
                    'leave_type_id' => $value['leaveTypeId'],
                    'due_days' => $value['dueDays'],
                    'leave_year_id' => $value['leaveYearId'],
                    'prepared_v_date' => $value['preparedVDate'],
                    'prepared_t_date' => $value['preparedTDate']
                )
            );
        };
        DB::table('hr_leave_credit')->insertOrIgnore($finalArray);
        return $this->standardResponse($data, 200);
    }
    public function DeleteAllLeaveCredits()
    {
        DB::table('hr_leave_credit')->truncate();
        return $this->standardResponse([], 200);
    }
}
