<?php


namespace Modules\Admin\Repositories;


use App\Constants\AppConstant;
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
                    'combined_code' => $parent["combined_code"] . '-' . $data['data']['individual_code'],
                    'top_level_id' => $parent->top_level_id
                ];
            }


            $data['data'] = array_merge($data['data'], $arrayToMerge);

            $data['data']['character_count'] = 2;
            DB::beginTransaction();
            $adminSegment = parent::create($data);
            $topLevelId = $adminSegment->id;
            if ($parentId) {
                $topLevelId = $parent->top_level_id;
                $parentCount = 1;
                UtilityService::recurseAndIncrementParentCount(AdminSegment::with('admin_segment_parent')->find($adminSegment->id), 'admin_segment_parent', $parentCount);

                $segmentLevel = AdminSegmentLevelConfig::where('admin_segment_id', $adminSegment->top_level_id)->where('level', $parentCount)->first();

                $adminSegment->character_count = $segmentLevel->count;
                if (strlen($data['data']['individual_code']) !== $segmentLevel->count) {
                    throw new AppException("segment code should be equals to level char count");
                }
                $adminSegment->save();
                /** @var AdminSegment $topLevelSegment */
                $topLevelSegment = AdminSegment::find($adminSegment->top_level_id);
                if ($parentCount > $topLevelSegment->top_level_child_count) {
                    $topLevelSegment->top_level_child_count = $parentCount;
                    $topLevelSegment->save();
                }
            } else {
                $adminSegment->top_level_id = $topLevelId;
                $adminSegment->save();
            }
            DB::commit();
            return $adminSegment;
        } catch (\Exception $exception) {

            DB::rollBack();
            throw $exception;
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
        /** @var AdminSegment $existingSegment */
        $existingSegment = AdminSegment::find($data['id']);
        if ($existingSegment->id == AdminSegment::SEGMENT_ECONOMIC_SEGMENT_ID && $data['data']['max_level'] < 5) {
            throw new AppException("Economic Segment levels can't be less tha 5");
        }
        if (isset($data['data']['max_level']) && $data['data']['max_level'] > $existingSegment->max_level) {

            for ($i = $existingSegment->max_level; $i < $data['data']['max_level']; ++$i) {
                AdminSegmentLevelConfig::create(['level' => $i + 1,
                    'count' => AppConstant::ADMIN_SEGMENT_CHARACTER_COUNT,
                    'admin_segment_id' => $existingSegment->id
                ]);
            }
        } else if (isset($data['data']['max_level']) && $data['data']['max_level'] < $existingSegment->max_level) {
            if ($existingSegment->top_level_child_count > $data['data']['max_level']) {
                throw new AppException("Child Level exceeded");
            }
            AdminSegmentLevelConfig::where('level', '>', $data['data']['max_level'])->where('admin_segment_id', $existingSegment->id)->delete();
        }

        $data['data'] = Arr::only($data['data'], $keysToUpdate);

        return parent::update($data);
    }

    public function levels($data)
    {

        $adminSegment = AdminSegment::find($data['data']['id']);

        if ($adminSegment->id == AdminSegment::SEGMENT_ECONOMIC_SEGMENT_ID && count($data['data']['levels']) < 5) {
            throw new AppException("Economic Segment levels can't be less tha 5");
        }
        if ($adminSegment->id == AdminSegment::SEGMENT_ECONOMIC_SEGMENT_ID && $data['data']['levels'][0] != 1) {
            throw new AppException("Economic Segment level 1 code count must be 1");
        }
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
