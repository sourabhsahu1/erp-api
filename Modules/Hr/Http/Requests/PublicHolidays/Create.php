<?php


namespace Modules\Hr\Http\Requests\PublicHolidays;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|unique:hr_public_holidays',
            'date'=> 'required|date',
            'isRepeatYearly'=> 'required|boolean',
            'isOneTime'=> 'required|boolean'
        ];
    }
}