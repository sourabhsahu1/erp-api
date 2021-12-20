<?php

namespace Modules\FixedAssets\Http\Controllers;

use App\Http\Controllers\BaseController;
use Modules\FixedAssets\Repositories\FixedAssetStatusRepository;

class FixAssetStatusController extends BaseController
{
    protected $repository = FixedAssetStatusRepository::class;
}
