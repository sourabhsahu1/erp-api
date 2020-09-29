<?php


namespace Modules\Admin\Repositories;



use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\Permission;
use Modules\Hr\Models\Role;

class RoleRepository extends EloquentBaseRepository
{

    public $model = Role::class;

    public function assignPermission($data)
    {
        $roleId = array_get($data['data'], 'id');
        $permissionIds = array_get($data['data'], 'permission_ids');
        $role = $this->model::find($roleId);
        $role->touch();
        $role->permissions()->sync($permissionIds);
        return Role::with('permissions')->find($roleId);
    }


    public function getPermissions($data)
    {
        $roleId = array_get($data['inputs'], 'id');
        $permissions= Permission::join('role_permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->where('role_permissions.role_id', $roleId)
            ->select(['permissions.*'])
            ->get();

        $module =[];
        foreach($permissions as $permission)
        {
            $module[$permission['module']][]=$permission->toArray();
        }
        return $module;
    }
}
