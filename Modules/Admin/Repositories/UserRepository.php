<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\User;
use Modules\Hr\Models\UserRole;

class UserRepository extends EloquentBaseRepository
{
    public $model = User::class;

    public function addRoleAssign($data)
    {

        $userRole = UserRole::create([
            'user_id' => $data['data']['id'],
            'role_id' => $data['data']['role_id'],
            'created_by_id' => $data['data']['user_id']
        ]);

        $user = User::with('roles')->where('id', $data['data']['id'])->first();
        return $user;

    }

    public function updateRoleAssign($data)
    {
        $userRole =  UserRole::where([
            'user_id' => $data['data']['id'],
            'role_id' => $data['data']['role_id']
        ])->orderBy('id', 'desc')->first();

        if (!$userRole) {
            UserRole::where('user_id', $data['data']['id'])->update([
                'user_id' => $data['data']['id'],
                'role_id' => $data['data']['role_id'],
                'created_by_id' => $data['data']['user_id']
            ]);
        }


        $user = User::with('roles')->where('id', $data['data']['id'])->first();
        return $user;
    }

    public function deleteRoleAssign($data)
    {
        $userRole = UserRole::where('user_id', $data['data']['id'])
            ->where('role_id' , $data['data']['role_id']);

        if (is_null($userRole->first())) {
            return ['message' => 'Already Deleted'];
        }
        $userRole = $userRole->forceDelete();
    }
}