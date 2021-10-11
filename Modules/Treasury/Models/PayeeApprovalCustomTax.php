<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 Oct 2021 10:42:52 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PayeeApprovalCustomTax
 *
 * @property int $id
 * @property int $payment_approval_payee_id
 * @property int $tax_id
 * @property float $tax_percentage
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Treasury\Models\PaymentApprovalPayee $payment_approval_payee
 * @property \Modules\Admin\Models\Tax $tax
 *
 * @package Modules\Treasury\Models
 */
class PayeeApprovalCustomTax extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'payment_approval_payee_id' => 'int',
		'tax_id' => 'int',
		'tax_percentage' => 'float'
	];

	protected $fillable = [
		'payment_approval_payee_id',
		'tax_id',
		'tax_percentage'
	];

	public function payment_approval_payee()
	{
		return $this->belongsTo(\Modules\Treasury\Models\PaymentApprovalPayee::class);
	}

	public function tax()
	{
		return $this->belongsTo(\Modules\Admin\Models\Tax::class, 'tax_id');
	}
}
