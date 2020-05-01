<?php


namespace Modules\Admin\Http\Requests\Roles;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            'roleId' => 'required|exists:roles,id'
        ];
    }
}