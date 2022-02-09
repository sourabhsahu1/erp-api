<?php

namespace Modules\FixedAssets\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\FixedAssets\Entities\FxaAsset;
use Modules\FixedAssets\Entities\FxaCategory;
use Modules\FixedAssets\Entities\FxaDepreciation;
use Modules\FixedAssets\Entities\FxaDepreciationDetail;

class FxaDepreciationDetailRepository extends EloquentBaseRepository
{
    public $model = FxaDepreciationDetail::class;

    public function create($data)
    {
        $categories = FxaCategory::with('fxa_assets')->Has('fxa_assets')->get();
        $srlNumber = $this->getSerialNumber();

        DB::beginTransaction();
        try {
            $fxDepricatedDetail= [];
            /** @var FxaCategory $category */
            foreach ($categories as $category) {
                $depreciaton = FxaDepreciation::create([
                    'vdate' => Carbon::now()->toDateTimeString(),
                    'tdate' => Carbon::now()->toDateTimeString(),
                    'employee_id' => Auth::id(),
                    'fxa_category_id' => $category->id
                ]);

                /** @var FxaAsset $asset */
                foreach ($category->fxa_assets as $asset) {
                    $temp = [
                        'depreciation_id' => $depreciaton->id,
                        'fxa_assets_id' => $asset->id,
                        'fxa_depr_method_id' => $asset->fxa_depr_method_id,
                        'serial_number' => $srlNumber,
                        'amount' => $this->getDepricatedAmount($asset),
                    ];
                    $fxDepricatedDetail[] = $temp;
                    $srlNumber = $srlNumber + 1;
                }
            }
            if (count($fxDepricatedDetail) > 0) {
                FxaDepreciationDetail::insert($fxDepricatedDetail);
            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw  $exception;
        }
        return ['data'=> 'success'];
    }

    /**
     * @param FxaAsset $asset
     */
    public function getDepricatedAmount($asset)
    {
        return ($asset->acquisition_cost - $asset->salvage_value) / $asset->expected_life;
    }

    public function getSerialNumber()
    {
        $fxDepreDetail = FxaDepreciationDetail::orderby('id','desc')->first();
        if (is_null($fxDepreDetail))
            return 1;
        return $fxDepreDetail->id + 1;

    }

}
