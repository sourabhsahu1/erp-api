<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 May 2020 17:07:08 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeePersonalDetail
 * 
 * @property int $id
 * @property int $employee_id
 * @property \Carbon\Carbon $date_of_birth
 * @property string $marital_status
 * @property string $gender
 * @property string $religion
 * @property string $phone
 * @property string $email
 * @property bool $is_permanent_staff
 * @property string $type_of_appointment
 * @property \Carbon\Carbon $appointed_on
 * @property \Carbon\Carbon $assumed_duty_on
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $hr_employee
 *
 * @package Modules\Hr\Models
 */
class EmployeePersonalDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = "hr_employee_personal_details";

	protected $casts = [
		'employee_id' => 'int',
		'is_permanent_staff' => 'bool'
	];

    public $filterable = [
        'date_of_birth',
        'appointed_on',
        'date_of_birth',
        'gender',
        'religion',
    ];
    public $searchable =[

    ];

	protected $dates = [
		'date_of_birth',
		'appointed_on',
		'assumed_duty_on'
	];

	protected $fillable = [
		'employee_id',
		'date_of_birth',
		'marital_status',
		'gender',
		'religion',
		'phone',
		'email',
		'is_permanent_staff',
		'type_of_appointment',
		'appointed_on',
		'assumed_duty_on'
	];

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
