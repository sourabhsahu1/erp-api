<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $name
 * @property boolean $is_active
 * @property int $parent_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Department $department
 * @property \Illuminate\Database\Eloquent\Collection $departments
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @property \Illuminate\Database\Eloquent\Collection $job_positions
 *
 * @package Modules\Hr\Models
 */
class Department extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "hr_departments";

    protected $casts = [
		'parent_id' => 'int',
		'is_active' => 'bool'
	];

    protected $fillable = [
		'name',
		'parent_id',
        'is_active'
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

	public function job_positions()
	{
		return $this->hasMany(\Modules\Hr\Models\JobPosition::class);
	}

    public function sub_categories()
    {
        return $this->children()->with('sub_categories');
    }

    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

}
