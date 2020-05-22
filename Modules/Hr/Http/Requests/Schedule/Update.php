<?php


namespace Modules\Hr\Http\Requests\Schedule;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('schedule');
        return [
            "name" => ["required", Rule::unique('hr_schedules')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}