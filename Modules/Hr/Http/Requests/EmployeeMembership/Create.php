<?php


namespace Modules\Hr\Http\Requests\EmployeeMembership;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'membershipId' => "required|exists:hr_memberships,id",
            'membershipRegistrationNumber' => "required",
            'membershipRank' => "required",
            'joinAt' => "required|date"
        ];
    }

}
