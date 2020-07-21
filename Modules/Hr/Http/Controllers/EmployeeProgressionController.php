<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\EmployeeProgressionHistory\Create;
use Modules\Hr\Http\Requests\EmployeeProgressionHistory\Update;
use Modules\Hr\Repositories\EmployeeProgressionRepository;

class EmployeeProgressionController extends BaseController
{

    protected $repository = EmployeeProgressionRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $indexWith = [
        'employee',
        'grade_level',
        'grade_level_step',
        'job_position',
        'salary_scale',
        'work_location'
    ];
}
