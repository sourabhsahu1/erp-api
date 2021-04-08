<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Jan 2021 18:05:21 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PaymentApproval
 *
 * @property int $id
 * @property int $admin_segment_id
 * @property int $fund_segment_id
 * @property int $economic_segment_id
 * @property string $employee_customer
 * @property int $prepared_by_id
 * @property int $authorised_by_id
 * @property int $currency_id
 * @property \Carbon\Carbon $value_date
 * @property \Carbon\Carbon $authorised_date
 * @property string $remark
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Admin\Models\AdminSegment $fund_segment
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 * @property \Modules\Finance\Models\Currency $currency
 * @property \Modules\Hr\Models\Employee $prepared_by
 * @property \Modules\Hr\Models\Employee $authorised_by
 * @property \Illuminate\Database\Eloquent\Collection $payment_approval_payees
 * @property \Illuminate\Database\Eloquent\Collection $treasury_payment_vouchers
 *
 * @package Modules\Treasury\Models
 */
class PaymentApproval extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;


    protected $table = 'treasury_payment_approvals';
    protected $casts = [
        'admin_segment_id' => 'int',
        'fund_segment_id' => 'int',
        'economic_segment_id' => 'int',
        'prepared_by_id' => 'int',
        'authorised_by_id' => 'int',
        'currency_id' => 'int'
    ];

    protected $dates = [
        'value_date',
        'authorised_date'
    ];

    protected $fillable = [
        'admin_segment_id',
        'fund_segment_id',
        'economic_segment_id',
        'employee_customer',
        'prepared_by_id',
        'authorised_by_id',
        'currency_id',
        'value_date',
        'authorised_date',
        'remark',
        'status'
    ];

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

    public function currency()
    {
        return $this->belongsTo(\Modules\Finance\Models\Currency::class);
    }

    public function prepared_by()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'prepared_by_id');
    }

    public function authorised_by()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'authorised_by_id');
    }


    public function payment_approval_payees()
    {
        return $this->hasMany(\Modules\Treasury\Models\PaymentApprovalPayee::class, 'payment_approval_id');
    }


    public function payment_vouchers()
    {
        return $this->hasMany(\Modules\Treasury\Models\PaymentVoucher::class, 'payment_approve_id');
    }

    public function total_amount()
    {
        return $this->hasOne(PaymentApprovalPayee::class,'payment_approval_id')
            ->selectRaw('payment_approval_id, SUM(net_amount) as net_amount')
            ->groupBy('payment_approval_id');
    }
    public function total_remaining_amount()
    {
        return $this->hasOne(PaymentApprovalPayee::class,'payment_approval_id')
            ->selectRaw('payment_approval_id, SUM(remaining_amount) as remaining_amount')
            ->groupBy('payment_approval_id');
    }

    public function total_tax()
    {
        return $this->hasOne(PaymentApprovalPayee::class,'payment_approval_id')
            ->selectRaw('payment_approval_id, SUM(total_tax) as total_tax')
            ->groupBy('payment_approval_id');
    }
}
