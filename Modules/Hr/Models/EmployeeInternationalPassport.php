<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 May 2020 17:08:30 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeInternationalPassport
 *
 * @property int $id
 * @property int $employee_id
 * @property string $passport_number
 * @property string $issued_at
 * @property \Carbon\Carbon $issued_date
 * @property \Carbon\Carbon $expiry_date
 * @property string $work_permit_number
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $hr_employee
 *
 * @package Modules\Hr\Models
 */
class EmployeeInternationalPassport extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_employee_international_passport';

    protected $casts = [
        'employee_id' => 'int'
    ];

    protected $dates = [
        'issued_date',
        'expiry_date'
    ];

    protected $fillable = [
        'employee_id',
        'passport_number',
        'issued_at',
        'issued_date',
        'expiry_date',
        'work_permit_number'
    ];

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
