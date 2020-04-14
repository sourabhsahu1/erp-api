<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Apr 2020 14:56:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Employee
 * 
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
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
 * @property \Carbon\Carbon $appointed
 * @property \Carbon\Carbon $assumed_duty
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\File $file
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $job_profiles
 *
 * @package App\Models
 */
class Employee extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'user_id' => 'int',
		'profile_image_id' => 'int',
		'is_permanent_staff' => 'bool'
	];

	protected $dates = [
		'date_of_birth',
		'appointed',
		'assumed_duty'
	];

	protected $fillable = [
		'user_id',
		'first_name',
		'last_name',
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
		'appointed',
		'assumed_duty'
	];

	public function file()
	{
		return $this->belongsTo(\App\Models\File::class, 'profile_image_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function job_profiles()
	{
		return $this->hasMany(\App\Models\JobProfile::class);
	}
}
