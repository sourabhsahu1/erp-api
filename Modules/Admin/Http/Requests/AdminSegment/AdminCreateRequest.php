<?php
/**
 * Created by PhpStorm.
 * User: vikram
 */

namespace Modules\Admin\Http\Requests\AdminSegment;

use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Admin\Models\AdminSegment;

class AdminCreateRequest extends BaseRequest
{

    function rules()
    {
        return [

            'name' => 'required|string|min:3',
            'individualCode' => 'required|string|min:2',
            'maxLevel' => 'required|integer|min:1',
            'characterCount' => ['required', 'min:1', function($a, $v, $f) {
                $parentId = $this->get('parentId');
                $individualCode = $this->get('individualCode');
                if (!is_null($parentId)) {

                    /** @var AdminSegment $parent */
                    $parent = AdminSegment::find($parentId);
                    if (is_null($parent)) return $f('Invalid parent id');

                    if (strlen($individualCode) > $parent->character_count){
                        return $f('Invalid individual code');
                    }
                }
            }],
            'parentId' => 'sometimes|required|integer'
        ];
    }
}
