<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Http\Requests\AdminSegment\AdminDeleteRequest;
use Modules\Admin\Repositories\AdminSegmentRepository;
use Modules\Admin\Http\Requests\AdminSegment\AdminCreateRequest;
use Modules\Admin\Http\Requests\AdminSegment\AdminUpdateRequest;

class AdminController extends BaseController
{
    protected $repository = AdminSegmentRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $indexWith = ['level_config'];
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = AdminCreateRequest::class;
    protected $updateRequest = AdminUpdateRequest::class;
    protected $deleteRequest = AdminDeleteRequest::class;

    public function levels(Request $request)
    {
        $this->jobMethod = "levels";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }
}
