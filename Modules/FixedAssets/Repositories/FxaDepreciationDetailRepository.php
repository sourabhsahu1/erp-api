<?php

namespace Modules\FixedAssets\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
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
            $fxDepricatedDetail = [];
            /** @var FxaCategory $category */
            foreach ($categories as $category) {

                $depreciaton = FxaDepreciation::where('fxa_category_id', $category->id)->first();
                if (is_null($depreciaton)) {
                    $depreciaton = FxaDepreciation::create([
                        'vdate' => Carbon::now()->toDateTimeString(),
                        'tdate' => Carbon::now()->toDateTimeString(),
                        'employee_id' => Auth::id(),
                        'fxa_category_id' => $category->id
                    ]);
                }

                /** @var FxaAsset $asset */
                foreach ($category->fxa_assets as $asset) {
                    if (($asset->is_depreciation_over == false) && ($asset->acquisition_cost_deprecated < (int)$this->getDepricatedAmount($category, $asset))) {
                        // add salvage value when depreciation is over
                        $asset->acquisition_cost_deprecated = $asset->acquisition_cost_deprecated + $asset->salvage_value;
                        $asset->is_depreciation_over = true;
                        $asset->save();
                        continue;
                    } elseif ($asset->is_depreciation_over == true) {
                        continue;
                    }

                    if ($this->getDepricatedAmount($category, $asset) < 0) {
                        continue;
                    }

                    $temp = [
                        'depreciation_id' => $depreciaton->id,
                        'fxa_assets_id' => $asset->id,
                        'fxa_depr_method_id' => $category->depreciation_method_id,
                        'serial_number' => $srlNumber,
                        'opening_balance' => $asset->acquisition_cost_deprecated,
                        'closing_balance' => $asset->acquisition_cost_deprecated - $this->getDepricatedAmount($category, $asset),
                        'amount' => $this->getDepricatedAmount($category, $asset),
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString()
                    ];

                    $asset->acquisition_cost_deprecated = $asset->acquisition_cost_deprecated - $this->getDepricatedAmount($category, $asset);
                    $asset->save();
                    $fxDepricatedDetail[] = $temp;
                    $srlNumber = $srlNumber + 1;
                }
            }
            if (count($fxDepricatedDetail) > 0) {
                FxaDepreciationDetail::insert($fxDepricatedDetail);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }
        return ['data' => 'success'];
    }

    /**
     * @param FxaAsset $asset
     */
    public function getDepricatedAmount($category, $asset)
    {
        if ($category->depreciation_method_id == 1) {
            return ($asset->acquisition_cost - $asset->salvage_value) / (100 / $category->depreciation_rate);
        } elseif ($category->depreciation_method_id == 2) {
            return ($asset->acquisition_cost_deprecated * 2 * $category->depreciation_rate)/100;
        } else {
            throw new AppException('Wrong method');
        }
    }

    public function getSerialNumber()
    {
        $fxDepreDetail = FxaDepreciationDetail::orderby('id', 'desc')->first();
        if (is_null($fxDepreDetail))
            return 1;
        return $fxDepreDetail->id + 1;

    }

}
