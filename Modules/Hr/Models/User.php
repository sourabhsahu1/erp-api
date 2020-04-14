<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Apr 2020 14:56:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $employees
 *
 * @package App\Models
 */
class User extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password'
	];

	public function employees()
	{
		return $this->hasMany(\App\Models\Employee::class);
	}
}
