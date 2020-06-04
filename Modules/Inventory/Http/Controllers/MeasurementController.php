<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Inventory\Http\Requests\Measurement\Create;
use Modules\Inventory\Http\Requests\Measurement\Update;
use Modules\Inventory\Repositories\MeasurementRepository;

class MeasurementController extends BaseController
{

    protected $repository = MeasurementRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
