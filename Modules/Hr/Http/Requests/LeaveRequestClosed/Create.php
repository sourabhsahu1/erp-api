<?php


namespace Modules\Hr\Http\Requests\LeaveRequestClosed;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "leaveRequestId" => "required",
            'daysSpent'=> 'required',
            'preparedVDate'=> 'required',
            'preparedTDate'=> 'required',
            'preparedLoginId'=> 'required',
            'requestReady'=> 'required',
            'hodStaffId'=> 'required',
            'approvedHod'=> '',
            'approvedHodVDate'=> '',
            'approvedHodTDate'=> '',
            'approvedHodLoginId'=> '',
            'approvedHrStaffId'=> '',
            'approvedHr'=> '',
            'approvedHrVDate'=> '',
            'approvedHrTDate'=> '',
            'approvedHrLoginId'=> '',
            'userRemarks'=> '',
            'hodRemarks'=> '',
            'HrRemarks'=> '',
        ];
    }
}