<?php


namespace Modules\Hr\Http\Requests\GLSteps;


use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\GradeLevel;
use Modules\Hr\Models\GradeLevelStep;
use Modules\Hr\Models\SalaryScale;

class GLStepsCreate extends BaseRequest
{
    public function rules()
    {
        return [
            'gradeLevelId' => ['required','exists:hr_grade_levels,id' , function($a, $v, $f) {
                /** @var GradeLevel $gradeLevel */
                $gradeLevel = GradeLevel::find($v);
                /** @var SalaryScale $salaryScale */
                $salaryScale = SalaryScale::find($gradeLevel->salary_scale_id);
                if (is_null($gradeLevel)) {
                    return $f('Grade Level Id not exist');
                }
                $currentGradeLevelStepsCount = GradeLevelStep::where('grade_level_id', $v)->count();
                if ($currentGradeLevelStepsCount >= $salaryScale->number_of_steps) {
                    return $f("Maximum level reached");
                }
            }],
            'name' => "required"
        ];
    }

}