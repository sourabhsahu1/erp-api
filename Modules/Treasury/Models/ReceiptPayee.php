<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 08 Dec 2020 13:05:48 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ReceiptPayee
 * 
 * @property int $id
 * @property int $receipt_voucher_id
 * @property int $employee_id
 * @property int $company_id
 * @property float $net_amount
 * @property float $total_tax
 * @property \Carbon\Carbon $year
 * @property string $details
 * @property string $pay_mode
 * @property string $instrument_number
 * @property string $instrument_type
 * @property string $instrument_teller_number
 * @property string $instrument_issued_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Admin\Models\Company $admin_company
 * @property \Modules\Hr\Models\Employee $hr_employee
 * @property \Modules\Treasury\Models\ReceiptVoucher $treasury_receipt_voucher
 * @property \Illuminate\Database\Eloquent\Collection $treasury_receipt_schedule_economics
 *
 * @package Modules\Treasury\Models
 */
class ReceiptPayee extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'receipt_voucher_id' => 'int',
		'employee_id' => 'int',
		'company_id' => 'int',
		'net_amount' => 'float',
		'total_tax' => 'float'
	];

	protected $dates = [
//		'year'
	];

	protected $fillable = [
		'receipt_voucher_id',
		'employee_id',
		'company_id',
		'net_amount',
		'total_tax',
		'year',
		'details',
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

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function treasury_receipt_voucher()
	{
		return $this->belongsTo(\Modules\Treasury\Models\ReceiptVoucher::class, 'receipt_voucher_id');
	}

	public function treasury_receipt_schedule_economics()
	{
		return $this->hasMany(\Modules\Treasury\Models\ReceiptScheduleEconomic::class, 'receipt_payee_id');
	}
}
