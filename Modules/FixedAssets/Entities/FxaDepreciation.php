<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Feb 2022 17:55:57 +0000.
 */

namespace Modules\FixedAssets\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FxaDepreciation
 *
 * @property int $id
 * @property \Carbon\Carbon $vdate
 * @property \Carbon\Carbon $tdate
 * @property bool $is_posted_to_gl
 * @property int $journal_voucher_id
 * @property int $fxa_category_id
 * @property int $employee_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\FixedAssets\Entities\FxaCategory $fxa_category
 * @property \Modules\Finance\Models\JournalVoucher $journal_voucher
 * @property \Illuminate\Database\Eloquent\Collection $fxa_depreciation_details
 *
 * @package Modules\Treasury\Models
 */
class FxaDepreciation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'is_posted_to_gl' => 'bool',
		'journal_voucher_id' => 'int',
		'fxa_category_id' => 'int',
		'employee_id' => 'int'
	];

	protected $dates = [
		'vdate',
		'tdate'
	];

	protected $fillable = [
		'vdate',
		'tdate',
		'is_posted_to_gl',
		'journal_voucher_id',
		'fxa_category_id',
		'employee_id'
	];

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function fxa_category()
	{
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaCategory::class);
	}

	public function journal_voucher()
	{
		return $this->belongsTo(\Modules\Finance\Models\JournalVoucher::class);
	}

	public function fxa_depreciation_details()
	{
		return $this->hasMany(\Modules\FixedAssets\Entities\FxaDepreciationDetail::class, 'depreciation_id');
	}
}
