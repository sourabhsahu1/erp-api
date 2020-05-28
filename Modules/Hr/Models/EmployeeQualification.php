<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:20:13 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeQualification
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $qualification_id
 * @property int $academic_id
 * @property int $country_id
 * @property string $institute_name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Academic $academic
 * @property \Modules\Hr\Models\Country $country
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\Qualification $qualification
 *
 * @package Modules\Hr\Models
 */
class EmployeeQualification extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = '_hr_employee_qualifications';
	protected $casts = [
		'employee_id' => 'int',
		'qualification_id' => 'int',
		'academic_id' => 'int',
		'country_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'qualification_id',
		'academic_id',
		'country_id',
		'institute_name'
	];

	public function academic()
	{
		return $this->belongsTo(\Modules\Hr\Models\Academic::class, 'academic_id');
	}

	public function country()
	{
		return $this->belongsTo(\Modules\Hr\Models\Country::class);
	}

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function qualification()
	{
		return $this->belongsTo(\Modules\Hr\Models\Qualification::class, 'qualification_id');
	}
}
