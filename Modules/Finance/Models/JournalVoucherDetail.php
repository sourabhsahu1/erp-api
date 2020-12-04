<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Sep 2020 04:09:37 +0000.
 */

namespace Modules\Finance\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JournalVoucherDetail
 * 
 * @property int $id
 * @property int $journal_voucher_id
 * @property string $currency
 * @property float $x_rate_local
 * @property float $bank_x_rate_to_usd
 * @property string $account_name
 * @property string $line_reference
 * @property string $line_currency
 * @property string $local_currency
 * @property int $admin_segment_id
 * @property int $fund_segment_id
 * @property int $economic_segment_id
 * @property int $programme_segment_id
 * @property int $functional_segment_id
 * @property int $geo_code_segment_id
 * @property string $line_value_type
 * @property int $lv_line_value
 * @property int $line_value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Finance\Models\JournalVoucher $journal_voucher
 *
 * @package Modules\Inventory\Models
 */
class JournalVoucherDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'journal_voucher_id' => 'int',
		'x_rate_local' => 'float',
		'bank_x_rate_to_usd' => 'float',
		'admin_segment_id' => 'int',
		'fund_segment_id' => 'int',
		'economic_segment_id' => 'int',
		'programme_segment_id' => 'int',
		'functional_segment_id' => 'int',
		'geo_code_segment_id' => 'int',
		'line_value' => 'float',
		'lv_line_value' => 'float'
	];

	protected $fillable = [
		'journal_voucher_id',
		'currency',
		'x_rate_local',
		'bank_x_rate_to_usd',
		'account_name',
		'line_reference',
		'line_value',
		'admin_segment_id',
		'fund_segment_id',
		'economic_segment_id',
		'programme_segment_id',
		'functional_segment_id',
		'geo_code_segment_id',
		'line_value_type',
		'lv_line_value',
        'local_currency'
	];

	public function programme_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'programme_segment_id');
	}
	public function admin_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'admin_segment_id');
	}
	public function fund_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fund_segment_id');
	}
	public function economic_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
	}
	public function functional_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'functional_segment_id');
	}
	public function geo_code_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'geo_code_segment_id');
	}

	public function journal_voucher()
	{
		return $this->belongsTo(\Modules\Finance\Models\JournalVoucher::class);
	}
}
