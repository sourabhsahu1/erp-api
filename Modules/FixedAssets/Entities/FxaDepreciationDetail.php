<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Feb 2022 16:56:03 +0000.
 */

namespace Modules\FixedAssets\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FxaDepreciationDetail
 *
 * @property int $id
 * @property int $depreciation_id
 * @property int $fxa_assets_id
 * @property int $fxa_depr_method_id
 * @property int $fxa_category_id
 * @property int $serial_number
 * @property int $amount
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\FixedAssets\Entities\FxaDepreciation $fxa_depreciation
 * @property \Modules\FixedAssets\Entities\FxaAsset $fxa_asset
 * @property \Modules\FixedAssets\Entities\FxaCategory $fxa_category
 * @property \Modules\FixedAssets\Entities\FxaDeprecationMethod $fxa_depreciation_method
 *
 * @package Modules\Treasury\Models
 */
class FxaDepreciationDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'depreciation_id' => 'int',
		'fxa_assets_id' => 'int',
		'fxa_depr_method_id' => 'int',
		'fxa_category_id' => 'int',
		'serial_number' => 'int',
		'amount' => 'float',
        'opening_balance' => 'float',
		'closing_balance' => 'float'
	];

	protected $fillable = [
		'depreciation_id',
		'fxa_assets_id',
		'opening_balance',
		'closing_balance',
		'fxa_depr_method_id',
		'fxa_category_id',
		'serial_number',
		'amount'
	];

	public function fxa_depreciation()
	{
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaDepreciation::class, 'depreciation_id');
	}

	public function fxa_asset()
	{
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaAsset::class, 'fxa_assets_id');
	}

	public function fxa_category()
	{
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaCategory::class);
	}

	public function fxa_depreciation_method()
	{
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaDeprecationMethod::class, 'fxa_depr_method_id');
	}
}
