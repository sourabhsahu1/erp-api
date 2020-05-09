<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\Employee\CreateRequest;
use Modules\Hr\Http\Requests\Employee\UpdateRequest;
use Modules\Hr\Http\Requests\EmployeeJobProfile\Create as CreateJobProfile;
use Modules\Hr\Http\Requests\EmployeePersonalDetail\Create as CreatePersonalDetail;
use Modules\Hr\Http\Requests\EmployeeContactDetail\Create as CreateContactDetail;
use Modules\Hr\Repositories\EmployeeRepository;

class EmployeeController extends BaseController
{

    protected $repository = EmployeeRepository::class;

    protected $storeJobMethod = "create";
    protected $createJob = BaseJob::class;
    protected $storeRequest = CreateRequest::class;

    protected $updateJobMethod = "update";
    protected $updateJob = BaseJob::class;
    protected $updateRequest = UpdateRequest::class;


    public function employeeDetails(Request $request) {
        $this->customRequest = CreatePersonalDetail::class;
        $this->jobMethod = "employeeDetails";
        return $this->handleCustomEndPoint(BaseJob::class , $request);
    }

    public function jobProfile(Request $request) {
        $this->customRequest = CreateJobProfile::class;
        $this->jobMethod = "jobProfile";
        return $this->handleCustomEndPoint(BaseJob::class , $request);
    }

    public function location(Request $request) {
        $this->customRequest = CreateContactDetail::class;
        $this->jobMethod = "location";
        return $this->handleCustomEndPoint(BaseJob::class , $request);
    }
}
