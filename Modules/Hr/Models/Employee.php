<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 May 2020 17:06:25 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Employee
 * 
 * @property int $id
 * @property string $personnel_file_number
 * @property string $last_name
 * @property string $first_name
 * @property string $other_name
 * @property string $title
 * @property int $profile_image_id
 * @property string $maiden_name
 * @property int $created_by_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\User $user
 * @property \Modules\Hr\Models\File $file
 * @property \Illuminate\Database\Eloquent\Collection $employee_contact_details
 * @property \Illuminate\Database\Eloquent\Collection $employee_id_nos
 * @property \Illuminate\Database\Eloquent\Collection $employee_international_passports
 * @property \Illuminate\Database\Eloquent\Collection $employee_job_profiles
 * @property \Illuminate\Database\Eloquent\Collection $employee_pensions
 * @property \Illuminate\Database\Eloquent\Collection $employee_personal_details
 * @property \Illuminate\Database\Eloquent\Collection $employee_progressions
 * @property \Illuminate\Database\Eloquent\Collection $employee_relatives
 * @property \Illuminate\Database\Eloquent\Collection $employee_languages
 * @property \Illuminate\Database\Eloquent\Collection $employee_arm_services
 *
 * @package Modules\Hr\Models
 */
class Employee extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'profile_image_id' => 'int',
		'created_by_id' => 'int'
	];

	protected $table = "hr_employees";
	protected $fillable = [
		'personnel_file_number',
		'last_name',
		'first_name',
		'other_name',
		'title',
		'profile_image_id',
		'maiden_name',
		'created_by_id'
	];

    public $filterable = [
        'id',
        'personnel_file_number',
    ];
    public $searchable = [
        'last_name',
        'first_name',
        'other_name',
        'title',
        'maiden_name'
    ];


	public function user()
	{
		return $this->belongsTo(\Modules\Hr\Models\User::class, 'created_by_id');
	}

	public function file()
	{
		return $this->belongsTo(\Modules\Hr\Models\File::class, 'profile_image_id');
	}

	public function employee_contact_details()
	{
		return $this->hasOne(\Modules\Hr\Models\EmployeeContactDetail::class, 'employee_id');
	}

	public function employee_id_nos()
	{
		return $this->hasOne(\Modules\Hr\Models\EmployeeIdNo::class, 'employee_id');
	}

	public function employee_international_passports()
	{
		return $this->hasOne(\Modules\Hr\Models\EmployeeInternationalPassport::class, 'employee_id');
	}

	public function employee_job_profiles()
	{
		return $this->hasOne(\Modules\Hr\Models\EmployeeJobProfile::class, 'employee_id');
	}

	public function employee_pensions()
	{
		return $this->hasOne(\Modules\Hr\Models\EmployeePension::class, 'employee_id');
	}

	public function employee_personal_details()
	{
		return $this->hasOne(\Modules\Hr\Models\EmployeePersonalDetail::class, 'employee_id');
	}

	public function employee_progressions()
	{
		return $this->hasOne(\Modules\Hr\Models\EmployeeProgression::class, 'employee_id');
	}

	public function employee_relatives()
	{
		return $this->hasMany(\Modules\Hr\Models\EmployeeRelation::class, 'employee_id');
	}


    public function employee_languages() {
        return $this->hasMany(\Modules\Hr\Models\EmployeeLanguage::class, 'employee_id');
    }

    public function employee_academics() {
        return $this->hasMany(\Modules\Hr\Models\EmployeeQualification::class, 'employee_id');
    }

}
