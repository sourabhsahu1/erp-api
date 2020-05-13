<?php


namespace Modules\Admin\Http\Requests\User;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => "sometimes",
            'email' =>['sometimes', 'email', Rule::unique('users')->ignore($this->route('user'))] ,
            'username' => ['sometimes', Rule::unique('users')->ignore($this->route('user'))],
            'password' => "sometimes|min:4",
            'fileId' => ['sometimes', 'exists:files,id']
        ];
    }

}