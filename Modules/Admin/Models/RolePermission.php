<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 23 Oct 2020 08:38:08 +0000.
 */

namespace Modules\Admin\Models;

use Modules\Hr\Models\Role;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RolePermission
 * 
 * @property int $id
 * @property int $role_id
 * @property int $permission_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Admin\Models
 */
class RolePermission extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'role_id' => 'int',
		'permission_id' => 'int'
	];

	protected $fillable = [
		'role_id',
		'permission_id'
	];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
