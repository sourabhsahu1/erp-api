<?php


namespace Modules\Hr\Http\Requests\LeaveGroupEntitlement;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            "leaveGroupId" => "required",
            "leaveTypeId" => "required",
            "dueDays" => "required",
        ];
    }
}
