<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GradeLevel
 * 
 * @property int $id
 * @property int $salary_scale_id
 * @property string $level
 * @property int $increment_due
 * @property int $promotion_due
 * @property int $confirm_after
 * @property int $retire_after
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\SalaryScale $salary_scale
 * @property \Illuminate\Database\Eloquent\Collection $grade_level_steps
 *
 * @package Modules\Hr\Models
 */
class GradeLevel extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'salary_scale_id' => 'int',
		'increment_due' => 'int',
		'promotion_due' => 'int',
		'confirm_after' => 'int',
		'retire_after' => 'int'
	];

	protected $fillable = [
		'salary_scale_id',
		'level',
		'increment_due',
		'promotion_due',
		'confirm_after',
		'retire_after'
	];

	public function salary_scale()
	{
		return $this->belongsTo(\Modules\Hr\Models\SalaryScale::class);
	}

	public function grade_level_steps()
	{
		return $this->hasMany(\Modules\Hr\Models\GradeLevelStep::class);
	}
}
