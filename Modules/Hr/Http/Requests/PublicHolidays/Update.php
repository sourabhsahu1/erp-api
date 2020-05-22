<?php


namespace Modules\Hr\Http\Requests\PublicHolidays;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        $id = $this->route('public_holiday');
        return [
            'name' => ['required', Rule::unique('hr_public_holidays')->ignore($id)],
            'date'=> 'required|date',
            'isRepeatYearly'=> 'required|boolean',
            'isOneTime'=> 'required|boolean'
        ];
    }
}