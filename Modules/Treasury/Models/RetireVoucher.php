<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 09 Jan 2021 18:59:18 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RetireVoucher
 * 
 * @property int $id
 * @property int $payment_voucher_id
 * @property \Carbon\Carbon $liability_value_date
 * @property int $amount
 * @property int $economic_segment_id
 * @property string $details
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 * @property \Modules\Treasury\Models\PaymentVoucher $payment_voucher
 *
 * @package Modules\Treasury\Models
 */
class RetireVoucher extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "treasury_retire_vouchers";

    protected $casts = [
        'payment_voucher_id' => 'int'
    ];

    protected $fillable = [
        'payment_voucher_id',
        'status'
    ];

	public function payment_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\PaymentVoucher::class, 'payment_voucher_id');
	}


    public function retire_liabilities()
    {
        return $this->hasMany(\Modules\Treasury\Models\RetireLiability::class, 'retire_voucher_id');
    }
}
