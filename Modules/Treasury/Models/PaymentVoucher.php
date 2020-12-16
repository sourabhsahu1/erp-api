<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 23 Nov 2020 08:35:52 +0000.
 */

namespace Modules\Treasury\Models;

use Illuminate\Support\Carbon;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PaymentVoucher
 *
 * @property int $id
 * @property int $voucher_source_unit_id
 * @property string $source_unit
 * @property int $deptal_id
 * @property int $voucher_number
 * @property \Carbon\Carbon $value_date
 * @property int $payment_approve_id
 * @property string $payee
 * @property string $type
 * @property string $status
 * @property int $currency_id
 * @property string $payment_description
 * @property float $x_rate
 * @property float $official_x_rate
 * @property int $aie_id
 * @property int $admin_segment_id
 * @property int $fund_segment_id
 * @property int $economic_segment_id
 * @property int $program_segment_id
 * @property int $functional_segment_id
 * @property int $geo_code_segment_id
 * @property int $checking_officer_id
 * @property int $paying_officer_id
 * @property int $financial_controller_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Treasury\Models\Aie $aie
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Finance\Models\Currency $currency
 * @property \Modules\Treasury\Models\VoucherSourceUnit $treasury_voucher_source_unit
 *
 * @package Modules\Treasury\Models
 */
class PaymentVoucher extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'treasury_payment_vouchers';

    protected $casts = [
        'voucher_source_unit_id' => 'int',
        'deptal_id' => 'int',
        'voucher_number' => 'int',
        'payment_approve_id' => 'int',
        'currency_id' => 'int',
        'x_rate' => 'float',
        'official_x_rate' => 'float',
        'aie_id' => 'int',
        'admin_segment_id' => 'int',
        'fund_segment_id' => 'int',
        'economic_segment_id' => 'int',
        'program_segment_id' => 'int',
        'functional_segment_id' => 'int',
        'geo_code_segment_id' => 'int',
        'checking_officer_id' => 'int',
        'paying_officer_id' => 'int',
        'financial_controller_id' => 'int'
    ];

    protected $dates = [
        'value_date'
    ];

    protected $fillable = [
        'voucher_source_unit_id',
        'source_unit',
        'deptal_id',
        'voucher_number',
        'value_date',
        'payment_approve_id',
        'payee',
        'type',
        'status',
        'currency_id',
        'payment_description',
        'x_rate',
        'official_x_rate',
        'aie_id',
        'admin_segment_id',
        'fund_segment_id',
        'economic_segment_id',
        'program_segment_id',
        'functional_segment_id',
        'geo_code_segment_id',
        'checking_officer_id',
        'paying_officer_id',
        'financial_controller_id'
    ];

    protected $appends = ['year', 'types','is_checked', 'is_payed', 'is_audited','is_approved'];

    public function getYearAttribute()
    {
        return Carbon::parse($this->value_date)->year;
    }

    public function getIsCheckedAttribute()
    {

        return is_null($this->checking_officer_id) ? false : true;
    }

    public function getIsPayedAttribute()
    {
        return is_null($this->paying_officer_id) ? false : true;
    }

    public function getIsApprovedAttribute()
    {
        return is_null($this->paying_officer_id) ? false : true;
    }


    public function getIsAuditedAttribute()
    {
        return is_null($this->financial_controller_id) ? false : true;
    }

    public function getTypesAttribute()
    {
        return [
            'name' => str_replace('_',' ', $this->type)
        ];
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

    public function aie()
    {
        return $this->belongsTo(\Modules\Treasury\Models\Aie::class, 'aie_id');
    }

    public function paying_officer()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'paying_officer_id');
    }

    public function checking_officer()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'checking_officer_id');
    }


    public function financial_controller()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'financial_controller_id');
    }

    public function currency()
    {
        return $this->belongsTo(\Modules\Finance\Models\Currency::class);
    }

    public function voucher_source_unit()
    {
        return $this->belongsTo(\Modules\Treasury\Models\VoucherSourceUnit::class, 'voucher_source_unit_id');
    }

    public function total_amount()
    {
        return $this->hasOne(PayeeVoucher::class,'payment_voucher_id')
            ->selectRaw('payment_voucher_id, sum(net_amount) as amount')
            ->groupBy('payment_voucher_id');
    }

    public function payee_vouchers() {
        return $this->hasMany(\Modules\Treasury\Models\PayeeVoucher::class, 'payment_voucher_id');
    }

    public function total_tax() {
        return $this->hasOne(PayeeVoucher::class,'payment_voucher_id')
            ->selectRaw('payment_voucher_id, sum(total_tax) as tax')
            ->groupBy('payment_voucher_id');
    }
}
