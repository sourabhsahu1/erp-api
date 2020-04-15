<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 15 Apr 2020 21:37:05 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Department $department
 * @property \Illuminate\Database\Eloquent\Collection $departments
 * @property \Illuminate\Database\Eloquent\Collection $employees
 *
 * @package Modules\Hr\Models
 */
class Department extends Eloquent
{
	protected $casts = [
		'parent_id' => 'int'
	];

	protected $fillable = [
		'name',
		'parent_id'
	];

	public function department()
	{
		return $this->belongsTo(\Modules\Hr\Models\Department::class, 'parent_id');
	}

	public function departments()
	{
		return $this->hasMany(\Modules\Hr\Models\Department::class, 'parent_id');
	}

	public function employees()
	{
		return $this->hasMany(\Modules\Hr\Models\Employee::class);
	}
}
