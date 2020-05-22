<?php


namespace Modules\Hr\Http\Requests\Languages;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_languages",
            "isActive" => "required|boolean"
        ];
    }

}