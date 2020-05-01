<?php


namespace Modules\Admin\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Http\Requests\Roles\Create;
use Modules\Admin\Http\Requests\Roles\Update;
use Modules\Admin\Repositories\UserRepository;

class UserController extends BaseController
{

    protected $repository = UserRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";

    public function addRoleAssign(Request $request)
    {
        $this->jobMethod = "addRoleAssign";
        $this->customRequest = Create::class;
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function updateRoleAssign(Request $request)
    {
        $this->jobMethod = "updateRoleAssign";
        $this->customRequest = Update::class;
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }


    public function deleteRoleAssign(Request $request)
    {
        $this->jobMethod = "deleteRoleAssign";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}