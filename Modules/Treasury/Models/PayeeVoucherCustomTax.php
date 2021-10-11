<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 Oct 2021 10:09:43 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PayeeVoucherCustomTax
 *
 * @property int $id
 * @property int $payee_voucher_id
 * @property int $tax_id
 * @property float $tax_percentage
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Treasury\Models\PayeeVoucher $payee_voucher
 * @property \Modules\Admin\Models\Tax $tax
 *
 * @package Modules\Treasury\Models
 */
class PayeeVoucherCustomTax extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'payee_voucher_id' => 'int',
		'tax_id' => 'int',
		'tax_percentage' => 'float'
	];

	protected $fillable = [
		'payee_voucher_id',
		'tax_id',
		'tax_percentage'
	];

	public function payee_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\PayeeVoucher::class, 'payee_voucher_id');
	}

	public function tax()
	{
		return $this->belongsTo(\Modules\Admin\Models\Tax::class, 'tax_id');
	}
}
