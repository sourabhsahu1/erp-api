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
            'hodStaffId'=> 'required',
            'approvedHod'=> 'nullable',
            'approvedHodVDate'=> 'nullable',
            'approvedHodTDate'=> 'nullable',
            'approvedHodLoginId'=> 'nullable',
            'approvedHrStaffId'=> 'nullable',
            'approvedHr'=> 'nullable',
            'approvedHrVDate'=> 'nullable',
            'approvedHrTDate'=> 'nullable',
            'approvedHrLoginId'=> 'nullable',
            'userRemarks'=> 'nullable',
            'hodRemarks'=> 'nullable',
            'HrRemarks'=> 'nullable',
            'requestClosed'=> 'nullable',
        ];
    }
}