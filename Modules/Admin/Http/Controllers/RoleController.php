<?php


namespace Modules\Admin\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Repositories\RoleRepository;

class RoleController extends BaseController
{
    protected $repository = RoleRepository::class;

    public function getPermissions(Request $request) {
        $this->jobMethod = "getPermissions";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }


    public function getRolePermissions(Request $request) {
        $this->jobMethod = "getRolePermissions";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function assignPermission(Request $request) {
        $this->jobMethod = "assignPermission";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
