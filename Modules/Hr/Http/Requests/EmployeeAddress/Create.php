<?php


namespace Modules\Hr\Http\Requests\EmployeeAddress;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'addressTypeId' => 'required|exists:hr_address_types,id',
            'countryId' => 'required|exists:countries,id',
            'regionId' => 'required|exists:regions,id',
            'stateId' => 'required|exists:states,id',
            'lgaId' => 'required|exists:lgas,id',
            'addressLine1'  => 'required',
            'addressLine2'  => 'sometimes',
            'city'  => 'required',
            'zipCode' => 'required'
        ];
    }
}
