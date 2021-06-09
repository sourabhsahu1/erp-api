<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Jun 2021 14:50:39 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JournalVoucherLog
 *
 * @property int $id
 * @property int $journal_voucher_id
 * @property string $previous_status
 * @property string $current_status
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Finance\Models\JournalVoucher $journal_voucher
 *
 * @package Modules\Treasury\Models
 */
class JournalVoucherLog extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'journal_voucher_id' => 'int',
		'admin_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'journal_voucher_id',
		'previous_status',
		'current_status',
		'date',
        'admin_id'
	];

	public function journal_voucher()
	{
		return $this->belongsTo(\Modules\Finance\Models\JournalVoucher::class);
	}
}
