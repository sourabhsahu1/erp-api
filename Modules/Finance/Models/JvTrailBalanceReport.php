<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 15 Oct 2020 06:27:31 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JvTrailBalanceReport
 * 
 * @property int $id
 * @property int $economic_segment_id
 * @property int $parent_id
 * @property int $credit
 * @property int $debit
 * @property int $balance
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 *
 * @package Modules\Inventory\Models
 */
class JvTrailBalanceReport extends Eloquent
{
	protected $table = 'jv_trail_balance_report';

	protected $casts = [
		'economic_segment_id' => 'int',
		'parent_id' => 'int',
		'credit' => 'int',
		'debit' => 'int',
		'balance' => 'int'
	];

	protected $fillable = [
		'economic_segment_id',
		'parent_id',
		'credit',
		'debit',
		'balance'
	];

	public function admin_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'parent_id');
	}
}
