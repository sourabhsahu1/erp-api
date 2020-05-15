<?php


namespace Modules\Hr\Http\Requests\JobPosition;


use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\JobPosition;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'parentId' => 'sometimes|exists:hr_job_positions,id',
            'name' => 'required',
            'departmentId'=> 'required|exists:admin_segments,id',
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
            'education'=> 'sometimes',
            "isChildEnabled" => ['sometimes', 'boolean', function($a, $v, $f) {
                $parentId = $this->get('parentId');
                if (!is_null($parentId)) {
                    /** @var JobPosition $jobPosition */
                    $jobPosition = JobPosition::find($parentId);

                    if ($jobPosition->is_child_enabled === false) {
                        return $f('Cannot Add sub-levels');
                    }

                }
            }]
        ];
    }
}