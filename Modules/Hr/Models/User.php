<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 11 May 2020 12:53:03 +0000.
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
 * @property int $file_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\File $file
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @property \Illuminate\Database\Eloquent\Collection $roles
 *
 * @package Modules\Hr\Models
 */
class User extends Authenticatable
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use HasApiTokens, Notifiable;
	protected $casts = [
		'file_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'username',
		'password',
		'file_id'
	];

	public function file()
	{
		return $this->belongsTo(\Modules\Hr\Models\File::class);
	}

	public function employees()
	{
		return $this->hasMany(\Modules\Hr\Models\Employee::class, 'created_by_id');
	}

	public function roles()
	{
		return $this->belongsToMany(\Modules\Hr\Models\Role::class, 'user_roles')
					->withPivot('id', 'created_by_id', 'deleted_at')
					->withTimestamps();
	}
}
