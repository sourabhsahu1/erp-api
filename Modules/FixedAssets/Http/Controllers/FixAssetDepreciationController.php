<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Modules\FixedAssets\Repositories\FxaDepreciationMethodRepository;

class FixAssetDepreciationController extends BaseController
{
    protected $repository = FxaDepreciationMethodRepository::class;
}
