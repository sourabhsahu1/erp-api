<?php


namespace Modules\Hr\Http\Requests\EmployeeProgression;


use Luezoid\Laravelcore\Requests\BaseRequest;

class EmployeeProgressionCreate extends BaseRequest
{

    public function rules()
    {
        return [
            'confirmationDueDate' => 'sometimes|date',
            'nextIncrement' => 'required|integer',
            'nextPromotion' => 'required|integer'
        ];
    }
}