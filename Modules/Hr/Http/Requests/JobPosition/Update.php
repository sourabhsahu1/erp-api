<?php


namespace Modules\Hr\Http\Requests\JobPosition;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            'departmentId'=> 'sometimes|exists:hr_departments,id',
            'designationId'=> 'sometimes|exists:hr_designations,id',
            'salaryScaleId'=> 'sometimes|exists:hr_salary_scales,id',
            'gradeLevelId'=> 'sometimes|exists:hr_grade_levels,id',
            'gradeLevelStepId'=> 'sometimes|exists:hr_grade_level_steps,id',
            'skillId'=> 'sometimes|exists:hr_skills,id',
            'costCenter'=> 'sometimes',
            'jobFamily'=> 'sometimes',
            'isApprovedPosition'=> 'sometimes|boolean',
            'isActive'=> 'sometimes|boolean',
            'activities'=> 'sometimes',
            'competences'=> 'sometimes',
            'jobDescriptionSummary'=> 'sometimes',
            'experience'=> 'sometimes',
            'education'=> 'sometimes'
        ];
    }
}