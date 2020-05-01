<?php


namespace Modules\Admin\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Repositories\UserRepository;

class UserController extends BaseController
{

    protected $repository = UserRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";

    public function updateRoleAssign(Request $request){
        $this->jobMethod = "updateRoleAssign";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }


    public function deleteRoleAssign(Request $request){
        $this->jobMethod = "deleteRoleAssign";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}