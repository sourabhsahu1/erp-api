<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Http\Requests\Aie\Create;
use Modules\Treasury\Http\Requests\Aie\Update;
use Modules\Treasury\Repositories\AieRepository;

class AieController extends BaseController
{

    protected $repository = AieRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $indexWith = [
        'fund_segment',
        'aie_economic_balances.economic_segment'
    ];
}
