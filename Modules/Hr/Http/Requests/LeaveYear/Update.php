<?php


namespace Modules\Hr\Http\Requests\LeaveYear;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            "year" => "required",
        ];
    }
}
