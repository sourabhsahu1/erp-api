<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jan 2021 11:08:53 +0000.
 */

namespace Modules\Treasury\Models;

use Illuminate\Support\Carbon;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PaymentApprovalPayee
 *
 * @property int $id
 * @property int $payment_approval_id
 * @property \Carbon\Carbon $year
 * @property string $details
 * @property int $employee_id
 * @property int $company_id
 * @property float $net_amount
 * @property float $remaining_amount
 * @property float $total_tax
 * @property array $tax_ids
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property \Modules\Admin\Models\Company $company
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Treasury\Models\PaymentApproval $payment_approval
 *
 * @package Modules\Treasury\Models
 */
class PaymentApprovalPayee extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $casts = [
        'payment_approval_id' => 'int',
        'employee_id' => 'int',
        'company_id' => 'int',
        'net_amount' => 'float',
        'remaining_amount' => 'float',
        'total_tax' => 'float',
//		'tax_ids' => 'json'
    ];

    protected $dates = [
//		'year'
    ];

    protected $appends = [
        'amount',
        'checked'
    ];

    public function getAmountAttribute()
    {
        return $this->net_amount - $this->remaining_amount;
    }

    public function getCheckedAttribute()
    {
        return ($this->net_amount > $this->remaining_amount) ? true : false;
    }

    protected $fillable = [
        'payment_approval_id',
        'year',
        'details',
        'employee_id',
        'company_id',
        'net_amount',
        'remaining_amount',
        'total_tax',
        'tax_ids'
    ];

    public function company()
    {
        return $this->belongsTo(\Modules\Admin\Models\Company::class, 'company_id');
    }

    public function employee()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
    }

    public function payment_approval()
    {
        return $this->belongsTo(\Modules\Treasury\Models\PaymentApproval::class, 'payment_approval_id');
    }
}
