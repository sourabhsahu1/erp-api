<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 22 Jul 2020 06:04:00 +0000.
 */

namespace Modules\Inventory\Models;

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
 * @property \Modules\Inventory\Models\AdminSegment $admin_segment
 * @property \Modules\Inventory\Models\HrDesignation $hr_designation
 * @property \Modules\Inventory\Models\HrEmployee $hr_employee
 * @property \Modules\Inventory\Models\HrGradeLevel $hr_grade_level
 * @property \Modules\Inventory\Models\HrGradeLevelStep $hr_grade_level_step
 * @property \Modules\Inventory\Models\HrJobPosition $hr_job_position
 * @property \Modules\Inventory\Models\HrSalaryScale $hr_salary_scale
 * @property \Modules\Inventory\Models\HrWorkLocation $hr_work_location
 *
 * @package Modules\Inventory\Models
 */
class HrEmployeeProgressionHistory extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

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



	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Inventory\Models\HrEmployee::class, 'employee_id');
	}

	public function hr_grade_level()
	{
		return $this->belongsTo(\Modules\Inventory\Models\HrGradeLevel::class, 'grade_level_id');
	}

	public function hr_grade_level_step()
	{
		return $this->belongsTo(\Modules\Inventory\Models\HrGradeLevelStep::class, 'grade_level_step_id');
	}

	public function hr_job_position()
	{
		return $this->belongsTo(\Modules\Inventory\Models\HrJobPosition::class, 'job_position_id');
	}

	public function hr_salary_scale()
	{
		return $this->belongsTo(\Modules\Inventory\Models\HrSalaryScale::class, 'salary_scale_id');
	}

	public function hr_work_location()
	{
		return $this->belongsTo(\Modules\Inventory\Models\HrWorkLocation::class, 'work_location_id');
	}
}
