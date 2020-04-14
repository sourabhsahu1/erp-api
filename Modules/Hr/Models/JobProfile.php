<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Apr 2020 14:56:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JobProfile
 * 
 * @property int $id
 * @property int $employee_id
 * @property string $job_position
 * @property string $admin_unit
 * @property string $work_location
 * @property string $designation
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Employee $employee
 *
 * @package App\Models
 */
class JobProfile extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'job_profile';

	protected $casts = [
		'employee_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'job_position',
		'admin_unit',
		'work_location',
		'designation'
	];

	public function employee()
	{
		return $this->belongsTo(\App\Models\Employee::class);
	}
}
