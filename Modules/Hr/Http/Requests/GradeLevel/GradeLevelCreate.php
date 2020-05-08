<?php


namespace Modules\Hr\Http\Requests\GradeLevel;


use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\GradeLevel;
use Modules\Hr\Models\SalaryScale;

class GradeLevelCreate extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'sometimes',
            'salaryScaleId' => ['required', function($a, $v, $f) {
                /** @var SalaryScale $salaryScale */
                $salaryScale = SalaryScale::find($v);
                if (is_null($salaryScale)) {
                    return $f('Salary-scale id not exist');
                }
                $currentGradeLevelCount = GradeLevel::where('salary_scale_id', $v)->count();
                if ($currentGradeLevelCount >= $salaryScale->number_of_levels) {
                    return $f("Maximum level reached");
                }
            }],
            'retireType' => ['required']
        ];
    }
}