<?php
/**
 * Created by PhpStorm.
 * User: vikram
 */

namespace Modules\Admin\Http\Requests\AdminSegment;

use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Admin\Models\AdminSegment;

class Create extends BaseRequest
{

    function rules()
    {
        return [

            'name' => 'required|min:1',
            'individualCode' => 'required|min:2',
            'maxLevel' => 'required|min:1',
            'characterCount' => ['required', 'min:1', function($a, $v, $f) {
                $parentId = $this->get('parentId');
                $individualCode = $this->get('individualCode');
                if (!is_null($parentId)) {
                    $parent = AdminSegment::find($parentId);

                    if (is_null($parent)) return $f('Invalid parent id');

                    /** condition to check if data with parent id is not present in table */
                    if ($parent) $parent = $parent->toArray();

                    if (strlen($individualCode) > $parent['character_count']){
                        return $f('Invalid individual code');
                    }
                }
            }],
            'parentId' => 'sometimes'
        ];
    }
}
