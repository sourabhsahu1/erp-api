<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 11 May 2020 07:21:07 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeProgression
 * 
 * @property int $id
 * @property int $employee_id
 * @property string $status
 * @property \Carbon\Carbon $confirmation_due_date
 * @property \Carbon\Carbon $confirmed_date
 * @property \Carbon\Carbon $last_increment
 * @property \Carbon\Carbon $next_increment_due_date
 * @property \Carbon\Carbon $last_promoted
 * @property \Carbon\Carbon $next_promotion_due_date
 * @property \Carbon\Carbon $expected_exit_date
 * @property \Carbon\Carbon $actual_exit_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $hr_employee
 *
 * @package Modules\Hr\Models
 */
class EmployeeProgression extends Eloquent
{
	protected $casts = [
		'employee_id' => 'int'
	];

	protected $dates = [
		'confirmation_due_date',
		'confirmed_date',
		'last_increment',
		'next_increment_due_date',
		'last_promoted',
		'next_promotion_due_date',
		'expected_exit_date',
		'actual_exit_date'
	];
	protected $table = "hr_employee_progressions";

	protected $fillable = [
		'employee_id',
		'status',
		'confirmation_due_date',
		'confirmed_date',
		'last_increment',
		'next_increment_due_date',
		'last_promoted',
		'next_promotion_due_date',
		'expected_exit_date',
		'actual_exit_date'
	];

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
