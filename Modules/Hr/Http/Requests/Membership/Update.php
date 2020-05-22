<?php


namespace Modules\Hr\Http\Requests\Membership;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('membership');
        return [
            "name" => ["required", Rule::unique('hr_memberships')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}