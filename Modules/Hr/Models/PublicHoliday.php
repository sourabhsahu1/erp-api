<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 29 Apr 2020 22:07:59 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PublicHoliday
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $date
 * @property bool $is_repeat_yearly
 * @property bool $is_one_time
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class PublicHoliday extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'is_repeat_yearly' => 'bool',
		'is_one_time' => 'bool'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'date',
		'is_repeat_yearly',
		'is_one_time'
	];
}
