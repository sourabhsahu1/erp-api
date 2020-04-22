<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 15 Apr 2020 21:37:05 +0000.
 */

namespace Modules\Hr\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
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
class User extends Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use HasApiTokens, Notifiable;
	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
        'email',
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
