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
 * @property string $nhf_number
 * @property string $tin_number
 * @property string $driver_license_number
 * @property string $bank_version_number
 * @property string $pension_fund_administration
 * @property string $national_id_number
 * @property int $pfa_number
 * @property string $payroll_pin
 * @property bool $is_foreign_employee
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

    protected $table = 'hr_employee_id_nos';

	protected $casts = [
		'employee_id' => 'int',
		'pfa_number' => 'int',
		'is_foreign_employee' => 'bool'
	];

	protected $fillable = [
        'employee_id',
        'nhf_number',
        'tin_number',
        'driver_license_number',
        'bank_version_number',
        'pension_fund_administration',
        'national_id_number',
        'payroll_pin',
        'is_foreign_employee',
        'pfa_number'
	];

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}
}
