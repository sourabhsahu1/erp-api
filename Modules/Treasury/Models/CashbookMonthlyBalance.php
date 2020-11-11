<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Nov 2020 20:10:15 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CashbookMonthlyBalance
 * 
 * @property int $id
 * @property int $cashbook_id
 * @property int $month
 * @property float $balance
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Treasury\Models\Cashbook $treasury_cashbook
 *
 * @package Modules\Treasury\Models
 */
class CashbookMonthlyBalance extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'treasury_cashbook_monthly_balance';

	protected $casts = [
		'cashbook_id' => 'int',
		'month' => 'int',
		'balance' => 'float'
	];

	protected $fillable = [
		'cashbook_id',
		'month',
		'balance'
	];

	public function treasury_cashbook()
	{
		return $this->belongsTo(\Modules\Treasury\Models\Cashbook::class, 'cashbook_id');
	}
}
