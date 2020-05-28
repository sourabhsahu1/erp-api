<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:19:53 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeSchool
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $schedule_id
 * @property int $country_id
 * @property string $school
 * @property string $address
 * @property \Carbon\Carbon $entered_at
 * @property \Carbon\Carbon $exited_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Country $country
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\Schedule $schedule
 *
 * @package Modules\Hr\Models
 */
class EmployeeSchool extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'hr_employee_schools';
	protected $casts = [
		'employee_id' => 'int',
		'schedule_id' => 'int',
		'country_id' => 'int'
	];

	protected $dates = [
		'entered_at',
		'exited_at'
	];

	protected $fillable = [
		'employee_id',
		'schedule_id',
		'country_id',
		'school',
		'address',
		'entered_at',
		'exited_at'
	];

	public function country()
	{
		return $this->belongsTo(\Modules\Hr\Models\Country::class);
	}

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function schedule()
	{
		return $this->belongsTo(\Modules\Hr\Models\Schedule::class, 'schedule_id');
	}
}
