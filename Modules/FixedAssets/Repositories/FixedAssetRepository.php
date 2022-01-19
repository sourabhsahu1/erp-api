<?php

namespace Modules\FixedAssets\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaAsset;
use Illuminate\Support\Facades\DB;

class FixedAssetRepository extends EloquentBaseRepository
{
    public $model = FxaAsset::class;

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $fixedAsset = parent::create($data);

            $fixedAssetDeployment = [
                'fxa_asset_id' => $fixedAsset->id,
                'custodian_id' => $data['data']['custodian_id'],
                'value_date' => $data['data']['value_date'],
                'admin_segment_id' => $data['data']['deployment_admin_segment_id'],
                'location_id' => $data['data']['location_id'],
                'remark' => $data['data']['deployment_remark'] ?? null,
                'created_by_id' => $data['data']['user_id']
            ];

            app()->make(FxaDeploymentRepository::class)->create(['data' => $fixedAssetDeployment]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
