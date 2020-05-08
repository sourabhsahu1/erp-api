<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\PublicHolidays\Create;
use Modules\Hr\Http\Requests\PublicHolidays\Update;
use Modules\Hr\Repositories\PublicHolidaysRepository;

class PublicHolidayController extends BaseController
{
    protected $repository = PublicHolidaysRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}