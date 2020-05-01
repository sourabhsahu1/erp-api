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
            'is_repeat_yearly'=> 'required|boolean',
            'is_one_time'=> 'required|boolean'
        ];
    }
}