<?php


namespace Modules\Hr\Http\Requests\LeaveGradeLevelEntitlement;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            "gradeId" => "required",
            "leaveTypeId" => "required",
            "dueDays" => "required",
        ];
    }

}