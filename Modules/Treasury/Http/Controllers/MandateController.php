<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\MandateRepository;

class MandateController extends BaseController
{

    protected $repository = MandateRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $indexWith = [
        'cashbook',
        'first_authorised',
        'second_authorised',
        'prepared'
    ];
}
