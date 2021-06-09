<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Jun 2021 10:38:03 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PaymentVouchersLog
 *
 * @property int $id
 * @property int $payment_voucher_id
 * @property string $previous_status
 * @property string $current_status
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Treasury\Models\PaymentVoucher $payment_voucher
 *
 * @package Modules\Treasury\Models
 */
class PaymentVouchersLog extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'payment_voucher_id' => 'int',
		'admin_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'payment_voucher_id',
		'previous_status',
		'current_status',
		'date',
        'admin_id'
	];

	public function payment_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\PaymentVoucher::class, 'payment_voucher_id');
	}
}
