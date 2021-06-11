<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 10 Jun 2021 13:29:27 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PaymentApprovalLog
 *
 * @property int $id
 * @property int $payment_approval_id
 * @property int $admin_id
 * @property string $previous_status
 * @property string $current_status
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Hr\Models\User $user
 * @property \Modules\Treasury\Models\PaymentApproval $payment_approval
 *
 * @package Modules\Treasury\Models
 */
class PaymentApprovalLog extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'payment_approval_id' => 'int',
		'admin_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'payment_approval_id',
		'admin_id',
		'previous_status',
		'current_status',
		'date'
	];

	public function user()
	{
		return $this->belongsTo(\Modules\Hr\Models\User::class, 'admin_id');
	}

	public function payment_approval()
	{
		return $this->belongsTo(\Modules\Treasury\Models\PaymentApproval::class, 'payment_approval_id');
	}
}
