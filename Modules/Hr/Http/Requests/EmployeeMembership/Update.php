<?php


namespace Modules\Hr\Http\Requests\EmployeeMembership;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'membershipId' => "sometimes|exists:hr_memberships,id",
            'membershipRegistrationNumber' => "sometimes",
            'membershipRank' => "sometimes",
            'joinAt' => "sometimes|date"
        ];
    }

}
