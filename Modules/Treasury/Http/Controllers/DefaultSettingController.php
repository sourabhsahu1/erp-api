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
    protected $indexWith = ['checking_officer','financial_controller','paying_officer','account_head','program_segment','economic_segment','functional_segment','geo_code_segment','admin_segment','fund_segment','sub_organisation'];
}
