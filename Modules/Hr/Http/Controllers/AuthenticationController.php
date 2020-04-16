<?php


namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\Auth\AuthRequest;
use Modules\Hr\Repositories\UserRepository;

class AuthenticationController extends BaseController
{
    protected $repository = UserRepository::class;

    public function doLogin(Request $request)
    {
        $this->removeDefaultMessage();
        $this->customRequest = AuthRequest::class;
        $this->jobMethod = 'authenticate';
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSelfData(Request $request)
    {
        $this->jobMethod = 'getSelfData';
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}