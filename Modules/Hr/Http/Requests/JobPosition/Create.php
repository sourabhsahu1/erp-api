<?php


namespace Modules\Hr\Http\Requests\JobPosition;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'parentId' => 'sometimes|exists:hr_job_positions,id',
            'name' => 'required',
            'departmentId'=> 'required|exists:hr_departments,id',
            'designationId'=> 'sometimes|exists:hr_designations,id',
            'salaryScaleId'=> 'required|exists:hr_salary_scales,id',
            'gradeLevelId'=> 'required|exists:hr_grade_levels,id',
            'gradeLevelStepId'=> 'required|exists:hr_grade_level_steps,id',
            'skillId'=> 'required|exists:hr_skills,id',
            'costCenter'=> 'sometimes',
            'jobFamily'=> 'sometimes',
            'isApprovedPosition'=> 'required|boolean',
            'isActive'=> 'required|boolean',
            'activities'=> 'sometimes',
            'competences'=> 'sometimes',
            'jobDescriptionSummary'=> 'sometimes',
            'experience'=> 'sometimes',
            'education'=> 'sometimes'
        ];
    }
}