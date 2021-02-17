<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 25 Nov 2020 04:46:03 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PayeeVoucher
 * 
 * @property int $id
 * @property int $payment_voucher_id
 * @property int $employee_id
 * @property int $company_id
 * @property float $net_amount
 * @property float $total_tax
 * @property array $tax_ids
 * @property string $details
 * @property \Carbon\Carbon $year
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Admin\Models\Company $admin_company
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Treasury\Models\PaymentVoucher $payment_voucher
 * @property \Illuminate\Database\Eloquent\Collection $schedule_economics
 *
 * @package Modules\Treasury\Models
 */
class PayeeVoucher extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "treasury_payee_vouchers";

	protected $casts = [
		'payment_voucher_id' => 'int',
		'employee_id' => 'int',
		'company_id' => 'int',
		'net_amount' => 'float',
		'total_tax' => 'float'
//        'tax_ids' => 'array'
	];

	protected $dates = [
//		'year'
	];

	protected $fillable = [
		'payment_voucher_id',
		'employee_id',
		'company_id',
		'net_amount',
		'total_tax',
		'year',
		'details',
        'tax_ids',
        'pay_mode',
        'instrument_number',
        'instrument_type',
        'instrument_teller_number',
        'instrument_issued_by'
	];

	public function admin_company()
	{
		return $this->belongsTo(\Modules\Admin\Models\Company::class, 'company_id');
	}

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function payment_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\PaymentVoucher::class, 'payment_voucher_id');
	}

	public function schedule_economics()
	{
		return $this->hasMany(\Modules\Treasury\Models\ScheduleEconomic::class, 'payee_voucher_id');
	}
//
//	public function sum_amount() {
//        return $this->hasMany(\Modules\Treasury\Models\ScheduleEconomic::class, 'payee_voucher_id');
//    }
}
