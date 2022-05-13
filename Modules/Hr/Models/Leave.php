<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 29 Apr 2020 22:07:33 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Leave
 * 
 * @property int $id
 * @property string $title
 * @property string $short_name
 * @property bool $is_paid_leave
 * @property bool $is_calender_days
 * @property bool $entitled_annually
 * @property bool $roll_over_unused_leave
 * @property bool $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Leave extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = "hr_leaves";
	protected $casts = [
		'is_paid_leave' => 'bool',
		'is_calender_days' => 'bool',
		'entitled_annually' => 'bool',
		'roll_over_unused_leave' => 'bool',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'title',
		'short_name',
		'is_paid_leave',
		'is_calender_days',
		'entitled_annually',
		'roll_over_unused_leave',
		'is_active',
	];
}
