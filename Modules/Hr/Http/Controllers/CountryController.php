<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Repositories\CountryRepository;

class CountryController extends BaseController
{

    protected $repository = CountryRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";

    public function getAllLocations(Request $request) {
        $this->jobMethod = "getAllLocations";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }
}