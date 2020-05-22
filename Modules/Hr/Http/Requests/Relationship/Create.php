<?php


namespace Modules\Hr\Http\Requests\Relationship;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_relationships",
            "isActive" => "required|boolean"
        ];
    }

}