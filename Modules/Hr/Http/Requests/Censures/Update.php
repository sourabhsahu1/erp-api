<?php


namespace Modules\Hr\Http\Requests\Censures;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('censure');
        return [
            "name" => ["required", Rule::unique('hr_censures')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}