<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 13 Dec 2021 18:38:03 +0000.
 */

namespace Modules\FixedAssets\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FxaStatus
 *
 * @property int $id
 * @property string $title
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $fxa_assets
 *
 * @package Modules\Treasury\Models
 */
class FxaStatus extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $fillable = [
		'title'
	];

	public function fxa_assets()
	{
		return $this->hasMany(\Modules\Treasury\Models\FxaAsset::class);
	}
}
