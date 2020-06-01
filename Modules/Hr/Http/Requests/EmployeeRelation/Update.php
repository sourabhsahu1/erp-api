<?php


namespace Modules\Hr\Http\Requests\EmployeeRelation;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'relationshipId' => "sometimes|exists:hr_relationships,id",
            'relativeId' => "sometimes|exists:hr_employees,id",
            'lastName' => "sometimes",
            'firstName' => "sometimes",
            'nationalId' => "sometimes",
            'gender' => "sometimes",
            'dateOfBirth' => "sometimes|date",
            'isNextOfKin' => "sometimes|boolean",
            'countryId' => "sometimes|exists:countries,id",
            'regionId' => "sometimes|exists:regions,id",
            'stateId' => "sometimes|exists:states,id",
            'lgaId' => "sometimes|exists:lgas,id",
            'addressLine1' => "sometimes",
            'addressLine2' => "sometimes",
            'city' => "sometimes",
            'zipCode' => "sometimes",
            'phone' => "sometimes|digits:10",
            'email' => "sometimes|email"
        ];
    }

}
