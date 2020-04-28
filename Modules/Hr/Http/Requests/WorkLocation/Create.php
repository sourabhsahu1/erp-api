<?php


namespace Modules\Hr\Http\Requests\WorkLocation;


use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\WorkLocation;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            "name" => "required",
            "parentId" => "sometimes",
            "isChildEnabled" => ['sometimes', 'boolean', function($a, $v, $f) {
                $parentId = $this->get('parentId');
                if (!is_null($parentId)) {
                    /** @var WorkLocation $workLocation */
                    $workLocation = WorkLocation::find($parentId);

                    if ($workLocation->is_child_enabled === false) {
                        return $f('Cannot Add sub-levels');
                    }

                }
            }]
        ];
    }
}