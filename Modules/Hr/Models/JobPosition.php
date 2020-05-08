<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JobPosition
 * 
 * @property int $id
 * @property int $parent_id
 * @property int $department_id
 * @property int $designation_id
 * @property int $salary_scale_id
 * @property int $grade_level_id
 * @property int $grade_level_step_id
 * @property int $skill_id
 * @property string $name
 * @property string $cost_center
 * @property string $job_family
 * @property bool $is_approved_position
 * @property bool $is_active
 * @property string $activities
 * @property string $competences
 * @property string $job_description_summary
 * @property string $experience
 * @property string $education
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Department $department
 * @property \Modules\Hr\Models\Designation $designation
 * @property \Modules\Hr\Models\GradeLevelStep $grade_level_step
 * @property \Modules\Hr\Models\Skill $skill
 *
 * @package Modules\Hr\Models
 */
class JobPosition extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "hr_job_positions";
	protected $casts = [
		'parent_id' => 'int',
		'department_id' => 'int',
		'designation_id' => 'int',
		'salary_scale_id' => 'int',
		'grade_level_id' => 'int',
		'grade_level_step_id' => 'int',
		'skill_id' => 'int',
		'is_approved_position' => 'bool',
		'is_active' => 'bool'
	];

	protected $fillable = [
	    'name',
	    'parent_id',
		'department_id',
		'designation_id',
        'salary_scale_id',
        'grade_level_id',
		'grade_level_step_id',
		'skill_id',
		'cost_center',
		'job_family',
		'is_approved_position',
		'is_active',
		'activities',
		'competences',
		'job_description_summary',
		'experience',
		'education'
	];

	public function department()
	{
		return $this->belongsTo(\Modules\Hr\Models\Department::class);
	}

	public function designation()
	{
		return $this->belongsTo(\Modules\Hr\Models\Designation::class);
	}

	public function grade_level_step()
	{
		return $this->belongsTo(\Modules\Hr\Models\GradeLevelStep::class);
	}

    public function job_positions()
    {
        return $this->hasMany(\Modules\Hr\Models\JobPosition::class, 'parent_id');
    }

    public function job_position()
    {
        return $this->belongsTo(\Modules\Hr\Models\JobPosition::class, 'parent_id');
    }

	public function skill()
	{
		return $this->belongsTo(\Modules\Hr\Models\Skill::class);
	}

    public function sub_categories()
    {
        return $this->children()->with('sub_categories');
    }

    public function children()
    {
        return $this->hasMany(JobPosition::class, 'parent_id');
    }
}
