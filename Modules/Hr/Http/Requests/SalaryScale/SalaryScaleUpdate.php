<?php


namespace Modules\Hr\Http\Requests\SalaryScale;


use Luezoid\Laravelcore\Requests\BaseRequest;

class SalaryScaleUpdate extends BaseRequest
{

    public function rules()
    {
        return [
          "name" => "required"
        ];
    }
}