<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 15 Apr 2020 21:37:05 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Employee
 * 
 * @property int $id
 * @property int $created_by_id
 * @property int $designation_id
 * @property int $department_id
 * @property string $first_name
 * @property string $last_name
 * @property string $title
 * @property int $profile_image_id
 * @property string $other_names
 * @property string $maiden_name
 * @property \Carbon\Carbon $date_of_birth
 * @property string $marital_status
 * @property string $gender
 * @property string $religion
 * @property string $phone
 * @property string $email
 * @property bool $is_permanent_staff
 * @property string $type_of_appointment
 * @property \Carbon\Carbon $appointed_on
 * @property \Carbon\Carbon $assumed_duty
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\User $user
 * @property \Modules\Hr\Models\Department $department
 * @property \Modules\Hr\Models\Designation $designation
 * @property \Modules\Hr\Models\File $file
 *
 * @package Modules\Hr\Models
 */
class Employee extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'created_by_id' => 'int',
		'designation_id' => 'int',
		'department_id' => 'int',
		'profile_image_id' => 'int',
		'is_permanent_staff' => 'bool'
	];

	protected $dates = [
		'date_of_birth',
		'appointed_on',
		'assumed_duty'
	];

	protected $fillable = [
		'created_by_id',
		'designation_id',
		'department_id',
		'first_name',
		'last_name',
		'title',
		'profile_image_id',
		'other_names',
		'maiden_name',
		'date_of_birth',
		'marital_status',
		'gender',
		'religion',
		'phone',
		'email',
		'is_permanent_staff',
		'type_of_appointment',
		'appointed_on',
		'assumed_duty'
	];

	public function user()
	{
		return $this->belongsTo(\Modules\Hr\Models\User::class, 'created_by_id');
	}

	public function department()
	{
		return $this->belongsTo(\Modules\Hr\Models\Department::class);
	}

	public function designation()
	{
		return $this->belongsTo(\Modules\Hr\Models\Designation::class);
	}

	public function file()
	{
		return $this->belongsTo(\Modules\Hr\Models\File::class, 'profile_image_id');
	}
}
