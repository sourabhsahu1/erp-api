<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\SalaryScale\SalaryScaleCreate;
use Modules\Hr\Http\Requests\SalaryScale\SalaryScaleUpdate;
use Modules\Hr\Repositories\SalaryScaleRepository;

class SalaryScaleController extends BaseController
{

    protected $repository = SalaryScaleRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeRequest = SalaryScaleCreate::class;
    protected $updateRequest = SalaryScaleUpdate::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $indexWith = ['grade_levels.grade_level_steps'];
}