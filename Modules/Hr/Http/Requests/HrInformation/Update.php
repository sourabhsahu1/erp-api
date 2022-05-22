<?php


namespace Modules\Hr\Http\Requests\HrInformation;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            "currentLeaveYearId" => "required",
        ];
    }
}
