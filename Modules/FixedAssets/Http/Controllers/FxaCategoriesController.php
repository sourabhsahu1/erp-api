<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\FixedAssets\Http\Requests\Categories\Create;
use Modules\FixedAssets\Http\Requests\Categories\Update;
use Modules\FixedAssets\Repositories\CategoriesRepository;

class FxaCategoriesController extends BaseController
{
    protected $repository = CategoriesRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
    protected $indexWith = ['fixed_asset_acct', 'accum_depr_acct', 'depr_exps_acct', 'sub_categories', 'sub_categories.fixed_asset_acct', 'sub_categories.accum_depr_acct', 'sub_categories.depr_exps_acct'];
}
