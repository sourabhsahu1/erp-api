<?php


namespace Modules\Admin\Repositories;


use App\Services\UtilityService;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Illuminate\Support\Arr;
use Modules\Admin\Models\AdminSegmentLevelConfig;


class AdminSegmentRepository extends EloquentBaseRepository
{
    public $model = AdminSegment::class;

    public function create($data)
    {
        try {
            $arrayToMerge = ['combined_code' => $data['data']['individual_code']];
            $parentId = Arr::get($data, 'data.parent_id');
            $parent = null;
            if ($parentId) {
                $parent = $this->find($parentId);

                $arrayToMerge = [
                    'max_level' => $parent->max_level - 1,
                    'combined_code' => $parent["combined_code"] . $data['data']['individual_code'],
                    'top_level_id' => $parent->top_level_id
                ];
            }


            $data['data'] = array_merge($data['data'], $arrayToMerge);


            DB::beginTransaction();
            $adminSegment = parent::create($data);
            $topLevelId = $adminSegment->id;
            if ($parentId) {
                $topLevelId = $parent->top_level_id;
                $parentCount = 0;
                UtilityService::recurseAndIncrementParentCount(AdminSegment::with('admin_segment_parent')->find($adminSegment->id), 'admin_segment_parent', $parentCount);
                AdminSegment::where('id', $topLevelId)->update(['top_level_child_count' => $parentCount]);
            } else {
                $adminSegment->top_level_id = $topLevelId;
                $adminSegment->save();
            }
            DB::commit();
            return $adminSegment;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new AppException("Record already present with provided segment code, please try other segment code.");
        }
    }

    public function getAll($params = [], $query = null)
    {
        $query = AdminSegment::where('parent_id', null);
        return parent::getAll($params, $query);
    }

    public function show($id, $params = null)
    {
        $params = [
            'with' => ['children', 'level_config']
        ];
        return parent::show($id, $params);
    }

    public function update($data)
    {
        $keysToUpdate = ['name', 'max_level'];
        $data['data'] = Arr::only($data['data'], $keysToUpdate);

        return parent::update($data);
    }

    public function levels($data)
    {

        $adminSegment = AdminSegment::find($data['data']['id']);
        AdminSegmentLevelConfig::where('admin_segment_id', $data['data']['id'])->delete();
        foreach ($data['data']['levels'] as $key => $levelObject) {
            AdminSegmentLevelConfig::create(['level' => $levelObject['level'],
                'count' => $levelObject['value'],
                'admin_segment_id' => $adminSegment->id
            ]);
        }
        return $adminSegment;
    }
}
