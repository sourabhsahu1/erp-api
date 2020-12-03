<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 25 Nov 2020 04:46:10 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TreasuryScheduleEconomic
 * 
 * @property int $id
 * @property int $payee_voucher_id
 * @property int $economic_segment_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Treasury\Models\PayeeVoucher $payee_voucher
 *
 * @package Modules\Treasury\Models
 */
class ScheduleEconomic extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = "treasury_schedule_economics";

	protected $casts = [
		'payee_voucher_id' => 'int',
		'economic_segment_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'payee_voucher_id',
		'economic_segment_id',
		'amount'
	];

	public function economic_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
	}

	public function payee_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\PayeeVoucher::class, 'payee_voucher_id');
	}
}
