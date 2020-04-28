<?php
/**
 * Created by PhpStorm.
 * User: vikram
 */

namespace Modules\Admin\Http\Requests\AdminSegment;

use Luezoid\Laravelcore\Requests\BaseRequest;

class AdminSegment extends BaseRequest
{

    function rules()
    {
        return [

            'name' => 'required|min:1',
            'individualCode' => 'required|min:2',
            'maxLevel' => 'required|min:1',
            'characterCount' => 'required|min:1',
            'parentId' => 'sometimes'
        ];
    }
}
