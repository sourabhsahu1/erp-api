<?php


namespace Modules\Hr\Http\Requests\EmployeeAddress;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'addressTypeId' => 'sometimes|required|exists:hr_address_types,id',
            'countryId' => 'sometimes|exists:countries,id',
            'regionId' => 'sometimes|exists:regions,id',
            'stateId' => 'sometimes|exists:states,id',
            'lgaId' => 'sometimes|exists:lgas,id',
            'addressLine1'  => 'sometimes',
            'addressLine2'  => 'sometimes',
            'city'  => 'sometimes',
            'zipCode' => 'sometimes'
        ];
    }

}
