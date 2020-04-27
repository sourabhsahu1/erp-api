<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Repositories\AdminSegmentRepository;

class AdminController extends BaseController
{
   protected $repository = AdminSegmentRepository::class;
   protected $createJob =  BaseJob::class;
   protected $updateJob = BaseJob::class;
   protected $deleteJob = BaseJob::class;
   protected $storeJobMethod = "create";
   protected $updateJobMethod = "update";
   protected $deleteJobMethod = "delete";
}
