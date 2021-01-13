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
 * @property int $employee_id
 * @property int $company_id
 * @property int $currency_id
 * @property \Carbon\Carbon $value_date
 * @property \Carbon\Carbon $authorised_date
 * @property string $remark
 * @property int $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Admin\Models\AdminSegment $fund_segment
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 * @property \Modules\Admin\Models\Company $company
 * @property \Modules\Finance\Models\Currency $currency
 * @property \Modules\Hr\Models\Employee $employee
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
        'employee_id' => 'int',
        'company_id' => 'int',
        'currency_id' => 'int',
        'amount' => 'int'
    ];

    protected $dates = [
        'value_date',
        'authorised_date'
    ];

    protected $fillable = [
        'admin_segment_id',
        'fund_segment_id',
        'economic_segment_id',
        'employee_id',
        'company_id',
        'currency_id',
        'value_date',
        'authorised_date',
        'remark',
        'amount'
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

    public function company()
    {
        return $this->belongsTo(\Modules\Admin\Models\Company::class, 'company_id');
    }

    public function currency()
    {
        return $this->belongsTo(\Modules\Finance\Models\Currency::class);
    }

    public function employee()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
    }
}
