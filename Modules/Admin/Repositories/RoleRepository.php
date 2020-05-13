<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Role;

class RoleRepository extends EloquentBaseRepository
{

    public $model = Role::class;
}