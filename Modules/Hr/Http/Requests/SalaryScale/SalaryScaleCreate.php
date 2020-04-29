<?php


namespace Modules\Hr\Http\Requests\SalaryScale;


use Luezoid\Laravelcore\Requests\BaseRequest;

class SalaryScaleCreate extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'isAutomaticCreate' => ["required", "boolean"],
            'numberOfLevels' => 'required|numeric|between:1,99',
            'numberOfSteps' => "required|numeric|between:1,99",
            'retireType' => 'required_with:isAutomaticCreate'
        ];
    }
}