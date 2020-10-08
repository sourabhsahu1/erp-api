<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Oct 2020 13:08:36 +0000.
 */

namespace Modules\Finance\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BudgetBreakup
 * 
 * @property int $id
 * @property int $budget_id
 * @property int $month
 * @property float $main_budget
 * @property float $supplementary_budget
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Finance\Models\Budget $budget
 *
 * @package Modules\Finance\Models
 */
class BudgetBreakup extends Eloquent
{

    use SoftDeletes;
	protected $casts = [
		'budget_id' => 'int',
		'month' => 'int',
		'main_budget' => 'float',
		'supplementary_budget' => 'float'
	];

	protected $fillable = [
		'budget_id',
		'month',
		'main_budget',
		'supplementary_budget'
	];

	public function budget()
	{
		return $this->belongsTo(\Modules\Finance\Models\Budget::class);
	}
}
