<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Nov 2020 15:15:17 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TreasuryAieEconomicBalance
 * 
 * @property int $id
 * @property int $aie_id
 * @property int $economic_segment_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Treasury\Models\Aie $aie
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 *
 * @package Modules\Treasury\Models
 */
class AieEconomicBalance extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'treasury_aie_economic_balances';
	protected $casts = [
		'aie_id' => 'int',
		'economic_segment_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'aie_id',
		'economic_segment_id',
		'amount'
	];

	public function aie()
	{
		return $this->belongsTo(\Modules\Treasury\Models\Aie::class, 'aie_id');
	}

	public function economic_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
	}
}
