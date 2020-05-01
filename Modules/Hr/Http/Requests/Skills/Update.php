<?php


namespace Modules\Hr\Http\Requests\Skills;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required",
            "isActive" => "required|boolean"
        ];
    }

}