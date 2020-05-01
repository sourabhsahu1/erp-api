<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\Languages\Create;
use Modules\Hr\Http\Requests\Languages\Update;
use Modules\Hr\Repositories\LanguageRepository;

class LanguageController extends BaseController
{

    protected $repository = LanguageRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}