<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $role
 * @property string $description
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package Modules\Hr\Models
 */
class Role extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $fillable = [
		'role',
		'description'
	];

    public function permissions()
    {
        return $this->belongsToMany(\Modules\Admin\Models\Permission::class, 'role_permissions')
            ->withPivot('id', 'deleted_at')
            ->withTimestamps();
    }


	public function users()
	{
		return $this->belongsToMany(\Modules\Hr\Models\User::class, 'user_roles')
					->withPivot('id')
					->withTimestamps();
	}
}
