<?php


namespace Modules\Hr\Http\Requests\EmployeeProgressionHistory;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {

        return [
            'jobPositionId' => 'sometimes|exists:hr_job_positions,id',
            'workLocationId' =>'sometimes|exists:hr_work_locations,id',
            'departmentId'=> 'sometimes|exists:admin_segments,id',
            'designationId'=> 'sometimes|exists:hr_designations,id',
            'salaryScaleId'=> 'sometimes|exists:hr_salary_scales,id',
            'gradeLevelId'=> 'sometimes|exists:hr_grade_levels,id',
            'gradeLevelStepId'=> 'sometimes|exists:hr_grade_level_steps,id',
            'valueDate'=>'sometimes|date',
        ];
    }
}
