<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 May 2020 17:08:02 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeePension
 * 
 * @property int $id
 * @property int $employee_id
 * @property bool $is_pension_started
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $hr_employee
 *
 * @package Modules\Hr\Models
 */
class EmployeePension extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'employee_id' => 'int',
		'is_pension_started' => 'bool'
	];

	protected $fillable = [
		'employee_id',
		'is_pension_started'
	];

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
