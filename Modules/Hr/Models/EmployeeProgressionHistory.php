<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Jul 2020 13:21:20 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class HrEmployeeProgressionHistory
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $job_position_id
 * @property int $designation_id
 * @property int $department_id
 * @property int $work_location_id
 * @property int $salary_scale_id
 * @property int $grade_level_id
 * @property int $grade_level_step_id
 * @property \Carbon\Carbon $value_date
 * @property bool $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\GradeLevel $grade_level
 * @property \Modules\Hr\Models\GradeLevelStep $grade_level_step
 * @property \Modules\Hr\Models\JobPosition $job_position
 * @property \Modules\Hr\Models\SalaryScale $salary_scale
 * @property \Modules\Hr\Models\WorkLocation $work_location
 * @property \Modules\Admin\Models\AdminSegment $department
 * @property \Modules\Hr\Models\Designation $designation
 *
 * @package Modules\Hr\Models
 */
class EmployeeProgressionHistory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;


	protected $table = "hr_employee_progression_histories";
	protected $casts = [
		'employee_id' => 'int',
		'job_position_id' => 'int',
		'designation_id' => 'int',
		'department_id' => 'int',
		'work_location_id' => 'int',
		'salary_scale_id' => 'int',
		'grade_level_id' => 'int',
		'grade_level_step_id' => 'int',
		'is_active' => 'bool'
	];

	protected $dates = [
		'value_date'
	];

	protected $fillable = [
		'employee_id',
		'job_position_id',
		'designation_id',
		'department_id',
		'work_location_id',
		'salary_scale_id',
		'grade_level_id',
		'grade_level_step_id',
		'value_date',
		'is_active'
	];

    public function department()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(\Modules\Hr\Models\Designation::class, 'designation_id');
    }

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function grade_level()
	{
		return $this->belongsTo(\Modules\Hr\Models\GradeLevel::class, 'grade_level_id');
	}

	public function grade_level_step()
	{
		return $this->belongsTo(\Modules\Hr\Models\GradeLevelStep::class, 'grade_level_step_id');
	}

	public function job_position()
	{
		return $this->belongsTo(\Modules\Hr\Models\JobPosition::class, 'job_position_id');
	}

	public function salary_scale()
	{
		return $this->belongsTo(\Modules\Hr\Models\SalaryScale::class, 'salary_scale_id');
	}

	public function work_location()
	{
		return $this->belongsTo(\Modules\Hr\Models\WorkLocation::class, 'work_location_id');
	}
}
