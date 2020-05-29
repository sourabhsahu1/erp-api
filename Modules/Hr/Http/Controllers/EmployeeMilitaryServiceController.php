<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Repositories\EmployeeMilitaryRepository;

class EmployeeMilitaryServiceController extends BaseController
{
    protected $repository = EmployeeMilitaryRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";

    public function show(Request $request, $id)
    {
        $id = $request->route()->parameters;
        return parent::show($request, $id);
    }
}
