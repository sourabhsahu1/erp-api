<?php


namespace Modules\Hr\Http\Requests\LeaveYear;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "year" => "required",
            'isActive'=> 'required|boolean',
        ];
    }
}