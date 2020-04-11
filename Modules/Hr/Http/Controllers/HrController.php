<?php

namespace Modules\Hr\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Hr\Repositories\SomeRepository;

class HrController extends BaseController
{

    protected $repository = SomeRepository::class;



}
