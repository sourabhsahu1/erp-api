<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 May 2020 17:07:19 +0000.
 */

namespace Modules\Hr\Models;

use Modules\Admin\Models\AdminSegment;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeJobProfile
 *
 * @property int $id
 * @property int $employee_id
 * @property int $job_position_id
 * @property int $designation_id
 * @property int $department_id
 * @property int $work_location_id
 * @property \Carbon\Carbon $current_appointment
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Hr\Models\Employee $hr_employee
 * @property \Modules\Hr\Models\JobPosition $job_position
 * @property \Modules\Hr\Models\WorkLocation $hr_work_location
 *
 * @package Modules\Hr\Models
 */
class EmployeeJobProfile extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
        'employee_id' => 'int',
        'job_position_id' => 'int',
        'designation_id' => 'int',
        'department_id' => 'int',
        'work_location_id' => 'int'
    ];

    protected $dates = [
        'current_appointment'
    ];

    protected $table = "hr_employee_job_profiles";

    protected $fillable = [
        'employee_id',
        'job_position_id',
        'designation_id',
        'department_id',
        'work_location_id',
        'current_appointment'
    ];

    public $filterable = [
        'job_position_id',
        'designation_id',
        'department_id',
        'work_location_id',
    ];

    public function hr_employee()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
    }

    public function job_position()
    {
        return $this->belongsTo(\Modules\Hr\Models\JobPosition::class, 'job_position_id');
    }

    public function department()
    {
        return $this->belongsTo(AdminSegment::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }


    public function work_location()
    {
        return $this->belongsTo(WorkLocation::class, 'work_location_id');
    }

}
