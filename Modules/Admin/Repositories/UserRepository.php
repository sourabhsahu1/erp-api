<?php


namespace Modules\Admin\Repositories;


use Illuminate\Support\Facades\Hash;
use Luezoid\Laravelcore\Exceptions\ValidationException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\User;
use Modules\Hr\Models\UserRole;

class UserRepository extends EloquentBaseRepository
{
    public $model = User::class;


    public function create($data)
    {
        $data['data']['password'] = Hash::make($data['data']['password']);
        return parent::create($data);
    }

    public function update($data)
    {
        if (isset($data['data']['password']))
            $data['data']['password'] = Hash::make($data['data']['password']);
        return parent::update($data);
    }

    public function addRoleAssign($data)
    {
        $userRole = UserRole::where([
            'user_id' => $data['data']['id'],
            'role_id' => $data['data']['role_id']
        ])->orderBy('id', 'desc')->first();

        if (is_null($userRole)) {
            $userRole = UserRole::create([
                'user_id' => $data['data']['id'],
                'role_id' => $data['data']['role_id'],
                'created_by_id' => $data['data']['user_id']
            ]);
        }


        $user = User::with('roles')->where('id', $data['data']['id'])->first();
        return $user;

    }

    public function updateRoleAssign($data)
    {
        $userRole = UserRole::where([
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
        UserRole::where('user_id', $data['data']['id'])
            ->where('role_id', $data['data']['role_id'])
            ->delete();

        return ['message' => 'Deleted Successfully'];
    }

    public function userProfileUpdate($data)
    {
        /** @var User $user */
        $user = User::find($data['data']['user_id']);

        if (isset($data['data']['old_password']) && $data['data']['new_password']) {

            if (!Hash::check($data['data']['old_password'], $user->password)) {
                throw new ValidationException('Incorrect Password');
            }

            $data['data']['password'] = Hash::make($data['data']['new_password']);
        }


        $data['id'] = $data['data']['user_id'];

        return parent::update($data);
    }
}
