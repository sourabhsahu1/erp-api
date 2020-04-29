<?php


namespace Modules\Hr\Http\Requests\GradeLevel;


use Luezoid\Laravelcore\Requests\BaseRequest;

class GradeLevelUpdate extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'sometimes',
            'salaryScaleId' => 'required|exists:hr_salary_scales,id',
            'incrementDue' => 'integer',
            'promotionDue' => 'integer',
            'confirmAfter' => 'integer',
            'retireAfter' => 'integer'
        ];
    }
}