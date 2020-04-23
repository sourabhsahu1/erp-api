<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class GradeLevelStep
 * 
 * @property int $id
 * @property int $grade_level_id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\GradeLevel $grade_level
 * @property \Illuminate\Database\Eloquent\Collection $job_positions
 *
 * @package Modules\Hr\Models
 */
class GradeLevelStep extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'grade_level_id' => 'int'
	];

	protected $fillable = [
		'grade_level_id',
		'name'
	];

	public function grade_level()
	{
		return $this->belongsTo(\Modules\Hr\Models\GradeLevel::class);
	}

	public function job_positions()
	{
		return $this->hasMany(\Modules\Hr\Models\JobPosition::class);
	}
}
