<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\GradeLevel\GradeLevelCreate;
use Modules\Hr\Http\Requests\GradeLevel\GradeLevelUpdate;
use Modules\Hr\Repositories\GradeLevelRepository;

class GradeLevelController extends BaseController
{
    protected $repository = GradeLevelRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeRequest = GradeLevelCreate::class;
    protected $updateRequest = GradeLevelUpdate::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
}