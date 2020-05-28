<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:19:36 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeePhoneNumber
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $phone_number_type_id
 * @property string $phone
 * @property string $extension
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\PhoneNumberType $phone_number_type
 *
 * @package Modules\Hr\Models
 */
class EmployeePhoneNumber extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = '';
	protected $casts = [
		'employee_id' => 'int',
		'phone_number_type_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'phone_number_type_id',
		'phone',
		'extension'
	];

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function hr_phone_number_type()
	{
		return $this->belongsTo(\Modules\Hr\Models\PhoneNumberType::class, 'phone_number_type_id');
	}
}
