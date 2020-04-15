<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 15 Apr 2020 21:37:05 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @property \Illuminate\Database\Eloquent\Collection $roles
 *
 * @package Modules\Hr\Models
 */
class User extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'username',
		'password'
	];

	public function employees()
	{
		return $this->hasMany(\Modules\Hr\Models\Employee::class, 'created_by_id');
	}

	public function roles()
	{
		return $this->belongsToMany(\Modules\Hr\Models\Role::class, 'user_roles')
					->withPivot('id')
					->withTimestamps();
	}
}
