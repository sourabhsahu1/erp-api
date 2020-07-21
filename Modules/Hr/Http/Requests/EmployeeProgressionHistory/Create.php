<?php


namespace Modules\Hr\Http\Requests\EmployeeProgressionHistory;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {

        return [
            'jobPositionId' => 'required|exists:hr_job_positions,id',
            'workLocationId' =>'required|exists:hr_work_locations,id',
            'departmentId'=> 'required|exists:admin_segments,id',
            'designationId'=> 'required|exists:hr_designations,id',
            'salaryScaleId'=> 'required|exists:hr_salary_scales,id',
            'gradeLevelId'=> 'required|exists:hr_grade_levels,id',
            'gradeLevelStepId'=> 'required|exists:hr_grade_level_steps,id',
            'valueDate'=>'required|date',
        ];
    }
}
