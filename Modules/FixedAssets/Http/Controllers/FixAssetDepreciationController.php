<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Modules\FixedAssets\Repositories\FixedAssetDepreciationRepository;

class FixAssetDepreciationController extends BaseController
{
    protected $repository = FixedAssetDepreciationRepository::class;
}
