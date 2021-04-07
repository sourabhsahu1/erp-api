<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Nov 2020 20:10:02 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cashbook
 *
 * @property int $id
 * @property int $economic_segment_id
 * @property string $cashbook_title
 * @property float $bank_statement
 * @property float $cashbook
 * @property float $x_rate_local_currency
 * @property int $payment_voucher_id
 * @property int $receipt_voucher_id
 * @property int $e_mandate
 * @property string $prefix
 * @property string $suffix
 * @property int $fund_owned_by
 * @property string $bank_account_number
 * @property int $bank_id
 * @property int $bank_branch_id
 * @property string $title
 * @property int $currency_id
 * @property string $type_of_account
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Hr\Models\BankBranch $bank_branch
 * @property \Modules\Hr\Models\Bank $bank
 * @property \Modules\Finance\Models\Currency $currency
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 * @property \Modules\Treasury\Models\CashbookType $fund_owned
 * @property \Illuminate\Database\Eloquent\Collection $cashbook_monthly_balances
 *
 * @package Modules\Treasury\Models
 */
class Cashbook extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = 'treasury_cashbooks';

	protected $casts = [
		'economic_segment_id' => 'int',
		'bank_statement' => 'float',
		'cashbook' => 'float',
		'x_rate_local_currency' => 'float',
		'payment_voucher_id' => 'int',
		'receipt_voucher_id' => 'int',
		'e_mandate' => 'int',
		'fund_owned_by' => 'int',
		'bank_id' => 'int',
		'bank_branch_id' => 'int',
		'currency_id' => 'int'
	];

	protected $fillable = [
		'economic_segment_id',
		'cashbook_title',
		'bank_statement',
		'cashbook',
		'x_rate_local_currency',
		'payment_voucher_id',
		'receipt_voucher_id',
		'e_mandate',
		'prefix',
		'suffix',
		'fund_owned_by',
		'bank_account_number',
		'bank_id',
		'bank_branch_id',
		'title',
		'currency_id',
		'type_of_account'
	];

    protected $searchable = ['id','cashbook','title','type_of_account'];

	public function bank_branch()
	{
		return $this->belongsTo(\Modules\Hr\Models\BankBranch::class, 'bank_branch_id');
	}

	public function bank()
	{
		return $this->belongsTo(\Modules\Hr\Models\Bank::class, 'bank_id');
	}

	public function currency()
	{
		return $this->belongsTo(\Modules\Finance\Models\Currency::class);
	}

	public function economic_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
	}

    public function fund_owned()
    {
        return $this->belongsTo(\Modules\Treasury\Models\CashbookType::class, 'fund_owned_by');
    }

	public function cashbook_monthly_balances()
	{
		return $this->hasMany(\Modules\Treasury\Models\CashbookMonthlyBalance::class, 'cashbook_id');
	}
}
