<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaCategory;
use Modules\FixedAssets\Entities\FxaDepreciationDetail;
use function foo\func;

class CategoriesRepository extends EloquentBaseRepository
{
    public $model = FxaCategory::class;

    public function create($data)
    {
        if (isset($data['data']['combined_code'])) {
            $data['data']['combined_code'] .= "\\" . $data['data']['individual_code'];
        } else {
            $data['data']['combined_code'] = $data['data']['individual_code'];
        }
        return parent::create($data);
    }

    public function getAll($params = [], $query = null)
    {
        if (!$query) {
            $query = FxaCategory::query();
        }
        if (isset($params['inputs']['is_parent'])) {
            $query->whereNull('parent_id');
            unset($params['inputs']['is_parent']);
        }
        return parent::getAll($params, $query);
    }

    public function update($data)
    {
        $depriciationDetail  =  FxaDepreciationDetail::where('fxa_category_id', $data['id'])->first();
        if ($depriciationDetail){
            unset($data['data']['depreciation_rate']);
            unset($data['data']['depreciation_method_id']);
        }
        return parent::update($data);
    }

    public function delete($data)
    {
        $categoryInUse = FxaCategory::whereHas('fxa_assets',function ($category,$data){
            $category->where('fxa_category_id', $data['id']);
        })->first();
        if (!is_null($categoryInUse)){
            throw new AppException('Category in Use, Cannot delete');
        }
        return parent::delete($data);
    }
}
