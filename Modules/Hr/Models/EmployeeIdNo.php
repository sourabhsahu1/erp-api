<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 May 2020 17:08:17 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeIdNo
 * 
 * @property int $id
 * @property int $employee_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $hr_employee
 *
 * @package Modules\Hr\Models
 */
class EmployeeIdNo extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'employee_id' => 'int'
	];

	protected $fillable = [
		'employee_id'
	];

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
