<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Jun 2021 14:50:30 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RetireVoucherLog
 *
 * @property int $id
 * @property int $retire_voucher_id
 * @property string $previous_status
 * @property string $current_status
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Treasury\Models\RetireVoucher $retire_voucher
 *
 * @package Modules\Treasury\Models
 */
class RetireVoucherLog extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'admin_id' => 'int',
		'retire_voucher_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'retire_voucher_id',
		'previous_status',
		'current_status',
		'date',
        'admin_id'
	];

	public function retire_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\RetireVoucher::class, 'retire_voucher_id');
	}
}
