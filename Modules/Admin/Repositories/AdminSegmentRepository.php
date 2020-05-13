<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Illuminate\Support\Arr;


class AdminSegmentRepository extends EloquentBaseRepository
{
    public $model = AdminSegment::class;

    public function create($data)
    {
        $arrayToMerge = ['combined_code' => $data['data']['individual_code']];
        $parentId = Arr::get($data, 'data.parent_id');

        if ($parentId) {
            $parent = $this->find($parentId);

            $arrayToMerge = [
                    'max_level' => $parent->max_level - 1,
                    'combined_code' => $parent["combined_code"].$data['data']['individual_code']
                ];
        }

        $data['data'] = array_merge($data['data'],$arrayToMerge);
        return parent::create($data);
    }

    public function getAll($params = [], $query = null)
    {
        $query = AdminSegment::where('parent_id', null);
        return parent::getAll($params, $query);
    }

    public function show($id, $params = null)
    {
        $params = [
            'with' => ['children']
        ];
        return parent::show($id, $params);
    }

    public function update($data)
    {
        $keysToUpdate = ['name'];
        $data['data'] = Arr::only($data['data'], $keysToUpdate);

        return parent::update($data);
    }

    public function delete($data)
    {
        $params = [
            'with' => ['children']
        ];
        $node = parent::show($data['id'], $params);
        $isChildPresent = count($node->children);

        if (!$isChildPresent) {
            return parent::delete($data);
        } else {
            throw new AppException('Can not delete child');
        }
    }
}
