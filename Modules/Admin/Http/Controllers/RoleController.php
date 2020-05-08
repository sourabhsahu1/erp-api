<?php


namespace Modules\Admin\Http\Controllers;


use App\Http\Controllers\BaseController;
use Modules\Admin\Repositories\RoleRepository;

class RoleController extends BaseController
{
    protected $repository = RoleRepository::class;

}