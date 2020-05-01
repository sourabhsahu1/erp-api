<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 01 May 2020 14:54:14 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserRole
 * 
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property int $created_by_id
 * @property string $deleted_at
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
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int',
		'created_by_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id',
		'created_by_id'
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
