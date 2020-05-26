<?php
/**
 * Created by PhpStorm.
 * User: vikram
 */

namespace Modules\Admin\Http\Requests\AdminSegment;

use Luezoid\Laravelcore\Exceptions\ValidationException;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Admin\Models\AdminSegment;

class AdminUpdateRequest extends BaseRequest
{

    function rules()
    {
        /** @var AdminSegment $adminSegment */
        $adminSegment = AdminSegment::find($this->route('id'));
        if (!$adminSegment) {
            throw new ValidationException("Admin Segment not found");
        }


        return [
            'name' => 'required|string|min:3',
            'maxLevel' => ['required', function ($a, $v, $f) use ($adminSegment) {
                if ($adminSegment->top_level_child_count > $v) {
                    return $f($adminSegment->top_level_child_count . " child already created, level should be greater than or equals to ".$adminSegment->top_level_child_count);
                }
            }]
        ];
    }
}
