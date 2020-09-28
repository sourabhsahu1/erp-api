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
        return Permission::join('role_permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->where('role_permissions.role_id', $roleId)
            ->select(['permissions.id','permissions.module','permissions.entity_name','permissions.name'])
            ->groupBy(['permissions.module','permissions.entity_name','permissions.name'])
            ->get();
    }
}
