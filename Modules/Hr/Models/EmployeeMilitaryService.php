<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:19:21 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeMilitaryService
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $arm_of_service_id
 * @property string $service_number
 * @property string $last_unit
 * @property \Carbon\Carbon $engaged_at
 * @property \Carbon\Carbon $discharged_at
 * @property string $reason_to_leave
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\ArmOfService $arm_of_service
 * @property \Modules\Hr\Models\Employee $employee
 *
 * @package Modules\Hr\Models
 */
class EmployeeMilitaryService extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = '';
	protected $casts = [
		'employee_id' => 'int',
		'arm_of_service_id' => 'int'
	];

	protected $dates = [
		'engaged_at',
		'discharged_at'
	];

	protected $fillable = [
		'employee_id',
		'arm_of_service_id',
		'service_number',
		'last_unit',
		'engaged_at',
		'discharged_at',
		'reason_to_leave'
	];

	public function arm_of_service()
	{
		return $this->belongsTo(\Modules\Hr\Models\ArmOfService::class, 'arm_of_service_id');
	}

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
