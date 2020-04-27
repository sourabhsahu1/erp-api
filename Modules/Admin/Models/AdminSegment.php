<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 25 Apr 2020 15:03:14 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AdminSegment
 *
 * @property int $id
 * @property string $name
 * @property int $character_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_At
 *
 * @package Modules\Admin\Models
 */
class AdminSegment extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'character_count' => 'int'
	];

	protected $dates = [
		'updated_At'
	];

	protected $fillable = [
		'name',
		'character_count',
		'updated_At',
        'id'
	];
}
