<?php
/**
 * Created by PhpStorm.
 * User: keshavashta
 * Date: 8/3/18
 * Time: 3:09 PM
 */

namespace Modules\Hr\Http\Requests\Auth;

use Luezoid\Laravelcore\Requests\BaseRequest;

class AuthRequest extends BaseRequest
{

    function rules()
    {
        return [

            'username' => 'required|min:1',
            'password' => 'required|min:3'
        ];
    }
}
