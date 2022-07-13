<?php


namespace Modules\Hr\Http\Requests\LeaveSalaryScaleEntitlement;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            "salaryId" => "required",
            "leaveTypeId" => "required",
            "dueDays" => "required",
        ];
    }
}
