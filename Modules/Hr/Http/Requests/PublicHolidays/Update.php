<?php


namespace Modules\Hr\Http\Requests\PublicHolidays;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'date'=> 'required|date',
            'isRepeatYearly'=> 'required|boolean',
            'isOneTime'=> 'required|boolean'
        ];
    }
}