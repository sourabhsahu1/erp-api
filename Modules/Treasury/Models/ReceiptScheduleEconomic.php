<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 08 Dec 2020 13:05:37 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ReceiptScheduleEconomic
 * 
 * @property int $id
 * @property int $receipt_payee_id
 * @property int $economic_segment_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Treasury\Models\ReceiptPayee $treasury_receipt_payee
 *
 * @package Modules\Treasury\Models
 */
class ReceiptScheduleEconomic extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "treasury_receipt_schedule_economics";
	protected $casts = [
		'receipt_payee_id' => 'int',
		'economic_segment_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'receipt_payee_id',
		'economic_segment_id',
		'amount'
	];


	public function admin_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
	}

	public function treasury_receipt_payee()
	{
		return $this->belongsTo(\Modules\Treasury\Models\ReceiptPayee::class, 'receipt_payee_id');
	}
}
