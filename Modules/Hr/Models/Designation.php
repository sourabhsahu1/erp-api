<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Designation
 * 
 * @property int $id
 * @property string $name
 * @property boolean $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @property \Illuminate\Database\Eloquent\Collection $job_positions
 *
 * @package Modules\Hr\Models
 */
class Designation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "hr_designations";

    protected $casts = [
        'is_active' => 'bool',
    ];

	protected $fillable = [
		'name',
        'is_active'
	];

	public function employees()
	{
		return $this->hasMany(\Modules\Hr\Models\Employee::class);
	}

	public function job_positions()
	{
		return $this->hasMany(\Modules\Hr\Models\JobPosition::class);
	}
}
