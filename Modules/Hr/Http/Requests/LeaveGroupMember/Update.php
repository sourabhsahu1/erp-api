<?php


namespace Modules\Hr\Http\Requests\LeaveGroupMember;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            "leaveGroupId" => "required",
            "staffId" => "required",
        ];
    }
}
