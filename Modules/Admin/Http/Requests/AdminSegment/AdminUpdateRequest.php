<?php
/**
 * Created by PhpStorm.
 * User: vikram
 */

namespace Modules\Admin\Http\Requests\AdminSegment;

use Luezoid\Laravelcore\Requests\BaseRequest;

class AdminUpdateRequest extends BaseRequest
{

    function rules()
    {
        return [

            'name' => 'required|string|min:3'
        ];
    }
}
