<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Nov 2020 11:13:32 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class VoucherSourceUnit
 * 
 * @property int $id
 * @property string $long_name
 * @property string $short_name
 * @property int $next_pv_index_number
 * @property int $next_rv_index_number
 * @property string $honour_certificate
 * @property int $checking_officer_id
 * @property int $paying_officer_id
 * @property int $financial_controller_id
 * @property int $retirement_id
 * @property int $reverse_voucher_id
 * @property int $revalidation_id
 * @property int $tax_voucher_id
 * @property boolean $is_personal_advance_unit
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 *
 * @package Modules\Treasury\Models
 */
class VoucherSourceUnit extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = "treasury_voucher_source_units";

	protected $casts = [
		'next_pv_index_number' => 'int',
		'next_rv_index_number' => 'int',
		'checking_officer_id' => 'int',
		'paying_officer_id' => 'int',
		'financial_controller_id' => 'int',
		'retirement_id' => 'int',
		'reverse_voucher_id' => 'int',
		'revalidation_id' => 'int',
		'tax_voucher_id' => 'int',
        'is_personal_advance_unit' => 'bool'
	];

	protected $fillable = [
		'long_name',
		'short_name',
		'next_pv_index_number',
		'next_rv_index_number',
		'honour_certificate',
		'checking_officer_id',
		'paying_officer_id',
		'financial_controller_id',
		'retirement_id',
		'reverse_voucher_id',
		'revalidation_id',
		'tax_voucher_id',
        'is_personal_advance_unit'
	];

	public function paying_officer()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'paying_officer_id');
	}

    public function financial_controller()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'financial_controller_id');
    }

    public function checking_officer()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'checking_officer_id');
    }

    public function retirement()
    {
        return $this->belongsTo(\Modules\Treasury\Models\VoucherSourceUnit::class, 'retirement_id');
    }

    public function reverse_voucher()
    {
        return $this->belongsTo(\Modules\Treasury\Models\VoucherSourceUnit::class, 'reverse_voucher_id');
    }

    public function revalidation()
    {
        return $this->belongsTo(\Modules\Treasury\Models\VoucherSourceUnit::class, 'revalidation_id');
    }

    public function tax_voucher()
    {
        return $this->belongsTo(\Modules\Treasury\Models\VoucherSourceUnit::class, 'tax_voucher_id');
    }


}
