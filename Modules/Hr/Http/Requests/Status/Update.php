<?php


namespace Modules\Hr\Http\Requests\Status;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('status');
        return [
            "name" => ["required", Rule::unique('hr_status')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}