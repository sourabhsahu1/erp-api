<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserRole
 * 
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Role $role
 * @property \Modules\Hr\Models\User $user
 *
 * @package Modules\Hr\Models
 */
class UserRole extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id'
	];

	public function role()
	{
		return $this->belongsTo(\Modules\Hr\Models\Role::class);
	}

	public function user()
	{
		return $this->belongsTo(\Modules\Hr\Models\User::class);
	}
}
