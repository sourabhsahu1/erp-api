<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SalaryScale
 * 
 * @property int $id
 * @property string $name
 * @property int $number_of_levels
 * @property int $number_of_steps
 * @property bool $is_automatic_create
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $grade_levels
 *
 * @package Modules\Hr\Models
 */
class SalaryScale extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "hr_salary_scales";

	protected $casts = [
		'number_of_levels' => 'int',
		'number_of_steps' => 'int',
        'is_automatic_create' => 'bool',
        'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'number_of_levels',
		'number_of_steps',
        'is_automatic_create',
        'is_active'
	];

	public function grade_levels()
	{
		return $this->hasMany(\Modules\Hr\Models\GradeLevel::class);
	}
}
