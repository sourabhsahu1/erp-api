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
 * @property string $name
 * @property string $short_name
 * @property bool $is_carry_over_unused_leave
 * @property bool $is_paid_leave
 * @property bool $is_calender_days
 * @property bool $is_active
 * @property bool $auto_create
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Leave extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'is_carry_over_unused_leave' => 'bool',
		'is_paid_leave' => 'bool',
		'is_calender_days' => 'bool',
		'is_active' => 'bool',
		'auto_create' => 'bool'
	];

	protected $fillable = [
		'name',
		'short_name',
		'is_carry_over_unused_leave',
		'is_paid_leave',
		'is_calender_days',
		'is_active',
		'auto_create'
	];
}
