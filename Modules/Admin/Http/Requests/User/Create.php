<?php


namespace Modules\Admin\Http\Requests\User;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => "required",
            'email' => "required|unique:users",
            'username' => "required|unique:users",
            'password' => "required|min:4",
            'fileId' => ['sometimes', 'exists:files,id']
        ];
    }
}