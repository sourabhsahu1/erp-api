<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Http\Requests\VoucherSourceUnit\Create;
use Modules\Treasury\Http\Requests\VoucherSourceUnit\Update;
use Modules\Treasury\Repositories\VoucherSourceUnitRepository;


class VoucherSourceUnitController extends BaseController
{

    protected $repository = VoucherSourceUnitRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
