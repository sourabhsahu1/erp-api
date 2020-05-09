<?php


namespace Modules\Hr\Http\Requests\EmployeeContactDetail;

use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'countryId' => 'required|exists:countries,id',
            'regionId' => 'required|exists:regions,id',
            'stateId' => 'required|exists:states,id',
            'lgaId' => 'required|exists:lgas,id',
            'addressLine1' => 'required',
            'addressLine2' => 'sometimes',
            'city' => 'required',
            'zipCode' => 'required',
            'otherCountryId' => 'required|exists:countries,id',
            'otherRegionId' => 'required|exists:regions,id',
            'otherStateId' => 'required|exists:states,id',
            'otherLgaId' => 'required|exists:lgas,id'
        ];
    }
}