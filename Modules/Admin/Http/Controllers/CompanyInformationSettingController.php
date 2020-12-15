<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Luezoid\Laravelcore\Http\Controllers\ApiController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Admin\Repositories\CompanyInformationSettingRepository;

class CompanyInformationSettingController extends ApiController
{
    protected $repository = CompanyInformationSettingRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";


    protected $indexWith = [
        'company_information',
        'local',
        'international'
    ];
}
