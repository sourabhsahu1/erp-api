<?php
/**
 * Created by PhpStorm.
 * User: vikram
 */

namespace Modules\Admin\Http\Requests\AdminSegment;

use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Admin\Models\AdminSegment;

class AdminDeleteRequest extends BaseRequest
{

    function rules()
    {
        return [
            'id' => ['required', 'min:1', function($a, $v, $f) {
                $node = AdminSegment::with('children')->where('id', $this->inputs['id'])->get()->toJson();
                $parsedData = json_decode($node);
                $isChildPresent = count($parsedData[0]->children);
                if ($isChildPresent) {
                    $f('Parent has associated child, please delete all child first.');
                }
            }]
        ];
    }
}
