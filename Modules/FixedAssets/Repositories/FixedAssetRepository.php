<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaAsset;
use Illuminate\Support\Facades\DB;
use Modules\FixedAssets\Entities\FxaCategory;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FixedAssetRepository extends EloquentBaseRepository
{
    public $model = FxaAsset::class;

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $fixedAssetCategory = FxaCategory::find($data['data']['fxa_category_id']);
            if (!$fixedAssetCategory) {
                throw new BadRequestHttpException('Invalid Category');
            }
            $data['data']['asset_no'] = $fixedAssetCategory->combined_code . '\\' . $fixedAssetCategory->next_asset_no;
            FxaCategory::where('id', $fixedAssetCategory->id)->increment('next_asset_no');

            $fixedAsset = parent::create($data);

            $fixedAssetDeployment = [
                'fxa_asset_id' => $fixedAsset->id,
                'custodian_id' => $data['data']['custodian_id'],
                'value_date' => $data['data']['value_date'],
                'admin_segment_id' => $data['data']['deployment_admin_segment_id'],
                'location_id' => $data['data']['location_id'],
                'remark' => $data['data']['deployment_remark'] ?? null,
                'user_id' => $data['data']['user_id']
            ];

            app()->make(FxaDeploymentRepository::class)->create(['data' => $fixedAssetDeployment]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
