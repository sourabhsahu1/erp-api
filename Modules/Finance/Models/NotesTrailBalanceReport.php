<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 19 Oct 2020 13:58:08 +0000.
 */

namespace Modules\Finance\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NotesTrailBalanceReport
 * 
 * @property int $id
 * @property int $jv_tb_report_id
 * @property bool $is_parent
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Finance\Models\JvTrailBalanceReport $jv_trail_balance_report
 *
 * @package Modules\Finance\Models
 */
class NotesTrailBalanceReport extends Eloquent
{
	protected $table = 'notes_trail_balance_report';

	protected $casts = [
		'jv_tb_report_id' => 'int',
		'is_parent' => 'bool'
	];

	protected $fillable = [
		'jv_tb_report_id',
		'is_parent'
	];

	public function jv_trail_balance_report()
	{
		return $this->belongsTo(\Modules\Finance\Models\JvTrailBalanceReport::class, 'jv_tb_report_id');
	}
}
