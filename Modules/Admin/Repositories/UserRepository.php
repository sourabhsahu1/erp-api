<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\User;

class UserRepository extends EloquentBaseRepository
{
    public $model = User::class;

    public function updateRoleAssign($data){
        RoleUser::create([
            'user_id' => $data['data']['id'],
            'role_id' => $data['data']['role_id']
        ]);
    }

    public function deleteRoleAssign($data){
        dd($data);
    }
}