<?php


namespace Modules\Inventory\Http\Requests\Category;


use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Inventory\Models\Category;

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
                    /** @var Category $category */
                    $category = Category::find($parentId);

                    if ($category->is_child_enabled === false) {
                        return $f('Cannot Add sub-levels');
                    }
                }
            }]
        ];
    }
}
