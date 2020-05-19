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
use Modules\Hr\Http\Requests\EmployeeProgression\EmployeeProgressionCreate;
use Modules\Hr\Http\Requests\EmployeeProgression\EmployeeStatusUpdate;
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
    protected $indexWith = [
        'employee_contact_details.country',
        'employee_contact_details.region',
        'employee_contact_details.state',
        'employee_contact_details.lga',
        'employee_contact_details.other_country',
        'employee_contact_details.other_region',
        'employee_contact_details.other_state',
        'employee_contact_details.other_lga',
        'employee_job_profiles.department',
        'employee_job_profiles.designation',
        'employee_job_profiles.job_position',
        'employee_job_profiles.job_position.salary_scale',
        'employee_job_profiles.job_position.grade_level',
        'employee_job_profiles.job_position.grade_level_step',
        'employee_job_profiles.work_location',
        'employee_personal_details',
        'employee_progressions',
        'employee_id_nos',
        'employee_international_passports',
        'employee_pensions',
        'file'
    ];
    
    public function employeeDetails(Request $request)
    {
        $this->customRequest = CreatePersonalDetail::class;
        $this->jobMethod = "employeeDetails";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function jobProfile(Request $request)
    {
        $this->customRequest = CreateJobProfile::class;
        $this->jobMethod = "jobProfile";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function location(Request $request)
    {
        $this->customRequest = CreateContactDetail::class;
        $this->jobMethod = "location";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function employeeProgression(Request $request)
    {
        $this->customRequest = EmployeeProgressionCreate::class;
        $this->jobMethod = "employeeProgression";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function setStatusForEmployee(Request $request)
    {
        $this->customRequest = EmployeeStatusUpdate::class;
        $this->jobMethod = "setStatusForEmployee";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function employeePension(Request $request)
    {
        $this->jobMethod = "employeePension";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function employeeIdNos(Request $request)
    {
        $this->jobMethod = "employeeIdNos";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function employeePassport(Request $request)
    {
        $this->jobMethod = "employeePassport";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function downloadReport(Request $request) {

        $this->jobMethod = "downloadReport";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}
