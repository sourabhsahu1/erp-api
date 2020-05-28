<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:20:04 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeBackground
 * 
 * @property int $id
 * @property int $employee_id
 * @property string $details
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 *
 * @package Modules\Hr\Models
 */
class EmployeeBackground extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_employee_background';

	protected $casts = [
		'employee_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'details'
	];

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
