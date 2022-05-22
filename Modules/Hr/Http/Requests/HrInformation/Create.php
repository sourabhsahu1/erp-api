<?php


namespace Modules\Hr\Http\Requests\HrInformation;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "currentLeaveYearId" => "required",
        ];
    }
}