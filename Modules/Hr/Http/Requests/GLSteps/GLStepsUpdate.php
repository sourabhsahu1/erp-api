<?php


namespace Modules\Hr\Http\Requests\GLSteps;


use Luezoid\Laravelcore\Requests\BaseRequest;

class GLStepsUpdate extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => "required"
        ];
    }
}