<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Jan 2021 08:04:54 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TreasuryRetireLiability
 *
 * @property int $id
 * @property \Carbon\Carbon $liability_value_date
 * @property int $amount
 * @property int $economic_segment_id
 * @property int $retire_voucher_id
 * @property int $employee_id
 * @property int $company_id
 * @property string $details
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 * @property \Modules\Treasury\Models\RetireVoucher $retire_voucher
 *
 * @package Modules\Treasury\Models
 */
class RetireLiability extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'amount' => 'int',
		'economic_segment_id' => 'int',
		'company_id' => 'int',
		'employee_id' => 'int',
		'retire_voucher_id' => 'int',
		'liability_value_date' => 'datetime:Y-m-d',
	];

    protected $table = "treasury_retire_liabilities";

	protected $dates = [
		'liability_value_date'
	];

	protected $fillable = [
		'liability_value_date',
		'amount',
		'company_id',
		'employee_id',
		'economic_segment_id',
		'retire_voucher_id',
		'details'
	];

	public function economic_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
	}

	public function retire_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\RetireVoucher::class, 'retire_voucher_id');
	}
}
