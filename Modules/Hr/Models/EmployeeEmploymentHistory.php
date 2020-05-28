<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:18:42 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeEmploymentHistory
 * 
 * @property int $id
 * @property int $employee_id
 * @property string $employer
 * @property \Carbon\Carbon $engaged
 * @property \Carbon\Carbon $disengaged
 * @property \Carbon\Carbon $total_remuneration
 * @property string $file_page
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 *
 * @package Modules\Hr\Models
 */
class EmployeeEmploymentHistory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_employee_employment_history';

	protected $casts = [
		'employee_id' => 'int'
	];

	protected $dates = [
		'engaged',
		'disengaged',
		'total_remuneration'
	];

	protected $fillable = [
		'employee_id',
		'employer',
		'engaged',
		'disengaged',
		'total_remuneration',
		'file_page'
	];

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
