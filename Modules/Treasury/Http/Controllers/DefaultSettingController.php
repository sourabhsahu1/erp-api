<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\DefaultSettingRepository;

class DefaultSettingController extends BaseController
{
    protected $repository = DefaultSettingRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
}
