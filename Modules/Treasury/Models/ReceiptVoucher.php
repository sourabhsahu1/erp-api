<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 08 Dec 2020 13:05:58 +0000.
 */

namespace Modules\Treasury\Models;

use Illuminate\Support\Carbon;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ReceiptVoucher
 * 
 * @property int $id
 * @property int $voucher_source_unit_id
 * @property string $source_department
 * @property int $deptal_id
 * @property int $voucher_number
 * @property \Carbon\Carbon $value_date
 * @property float $receipt_number
 * @property string $payee
 * @property string $type
 * @property string $status
 * @property string $payment_description
 * @property float $x_rate
 * @property float $official_x_rate
 * @property int $admin_segment_id
 * @property int $fund_segment_id
 * @property int $economic_segment_id
 * @property int $program_segment_id
 * @property int $functional_segment_id
 * @property int $geo_code_segment_id
 * @property int $receiving_officer_id
 * @property int $prepared_by_officer_id
 * @property int $closed_by_officer_id
 * @property int $cashbook_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Treasury\Models\Cashbook $treasury_cashbook
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Treasury\Models\VoucherSourceUnit $treasury_voucher_source_unit
 * @property \Illuminate\Database\Eloquent\Collection $treasury_receipt_payees
 *
 * @package Modules\Treasury\Models
 */
class ReceiptVoucher extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = "treasury_receipt_vouchers";
	protected $casts = [
		'voucher_source_unit_id' => 'int',
		'deptal_id' => 'int',
		'voucher_number' => 'int',
		'receipt_number' => 'float',
		'x_rate' => 'float',
		'official_x_rate' => 'float',
		'admin_segment_id' => 'int',
		'fund_segment_id' => 'int',
		'economic_segment_id' => 'int',
		'program_segment_id' => 'int',
		'functional_segment_id' => 'int',
		'geo_code_segment_id' => 'int',
		'receiving_officer_id' => 'int',
		'prepared_by_officer_id' => 'int',
		'closed_by_officer_id' => 'int',
		'cashbook_id' => 'int'
	];

	protected $dates = [
		'value_date'
	];

	protected $fillable = [
		'voucher_source_unit_id',
		'source_department',
		'deptal_id',
		'voucher_number',
		'value_date',
		'receipt_number',
		'payee',
		'type',
		'status',
		'payment_description',
		'x_rate',
		'official_x_rate',
		'admin_segment_id',
		'fund_segment_id',
		'economic_segment_id',
		'program_segment_id',
		'functional_segment_id',
		'geo_code_segment_id',
		'receiving_officer_id',
		'prepared_by_officer_id',
		'closed_by_officer_id',
		'cashbook_id'
	];

    protected $appends = ['year'];

    public function getYearAttribute()
    {
        return Carbon::parse($this->value_date)->year;
    }

    public function program_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'program_segment_id');
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

    public function admin_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'admin_segment_id');
    }

    public function fund_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fund_segment_id');
    }

	public function cashbook()
	{
		return $this->belongsTo(\Modules\Treasury\Models\Cashbook::class, 'cashbook_id');
	}

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'receiving_officer_id');
	}

	public function voucher_source_unit()
	{
		return $this->belongsTo(\Modules\Treasury\Models\VoucherSourceUnit::class, 'voucher_source_unit_id');
	}

	public function receipt_payees()
	{
		return $this->hasMany(\Modules\Treasury\Models\ReceiptPayee::class, 'receipt_voucher_id');
	}

    public function total_amount()
    {
        return $this->hasOne(ReceiptPayee::class,'receipt_voucher_id')
            ->selectRaw('receipt_voucher_id, sum(net_amount) as amount')
            ->groupBy('receipt_voucher_id');
    }

    public function total_tax() {
        return $this->hasOne(ReceiptPayee::class,'receipt_voucher_id')
            ->selectRaw('receipt_voucher_id, sum(total_tax) as tax')
            ->groupBy('receipt_voucher_id');
    }

}
