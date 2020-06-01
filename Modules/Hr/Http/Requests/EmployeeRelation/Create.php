<?php


namespace Modules\Hr\Http\Requests\EmployeeRelation;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'relationshipId' => "required|exists:hr_relationships,id",
            'relativeId' => "sometimes|exists:hr_employees,id",
            'lastName' => "required",
            'firstName' => "required",
            'nationalId' => "required",
            'gender' => "required",
            'dateOfBirth' => "required|date",
            'isNextOfKin' => "required|boolean",
            'countryId' => "required|exists:countries,id",
            'regionId' => "required|exists:regions,id",
            'stateId' => "required|exists:states,id",
            'lgaId' => "required|exists:lgas,id",
            'addressLine1' => "required",
            'addressLine2' => "sometimes",
            'city' => "required",
            'zipCode' => "required",
            'phone' => "required|digits:10",
            'email' => "required|email"
        ];
    }

}
