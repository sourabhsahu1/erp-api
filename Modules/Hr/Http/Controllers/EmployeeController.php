<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\Employee\CreateRequest;
use Modules\Hr\Repositories\EmployeeRepository;

class EmployeeController extends BaseController
{

    protected $repository = EmployeeRepository::class;

    protected $storeJobMethod = "create";
    protected $createJob = BaseJob::class;
    protected $storeRequest = CreateRequest::class;

    protected $updateJobMethod = "update";
    protected $updateJob = BaseJob::class;
    protected $updateRequest = BaseJob::class;


    public function updateJobProfile(Request $request)
    {
        $this->jobMethod = "updateJobProfile";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function updateLocation(Request $request)
    {
        $this->jobMethod = "updateLocation";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
