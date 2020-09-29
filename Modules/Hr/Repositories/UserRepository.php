<?php


namespace Modules\Hr\Repositories;


use Illuminate\Support\Facades\Auth;
use Luezoid\Laravelcore\Exceptions\InvalidCredentialsException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends EloquentBaseRepository
{
    public function __construct()
    {
        $this->model = User::class;
    }

    /**
     * @param $data
     * @return array
     * @throws InvalidCredentialsException
     */
    public function authenticate($data)
    {
        $username = array_get($data['data'], 'username');
        $password = array_get($data['data'], 'password');

        $credentials = ["username" => $username, 'password' => $password];
        $user = User::with('roles')->where("username", "=", $username)->first();

        if (!$user) {
            throw new NotFoundHttpException(__('errors.user_not_found'));
        }

        if (!Auth::attempt($credentials))
            throw new InvalidCredentialsException(__('errors.invalid_credentials'), 401);

        $token = $user->createToken('Personal Access Token')->accessToken;

        return ['user' => $user, 'token' => $token];
    }

    public function getSelfData($params)
    {
        $userId = $params['data']['user_id'];

        $selfData = User::with(['file','roles'])->find($userId);

        $permissions = Permission::join('role_permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->whereIn('role_permissions.role_id', $roleIds)
            ->select('permissions.*')
            ->distinct()
            ->get();
        dd($selfData);
        return $selfData;
    }
}
