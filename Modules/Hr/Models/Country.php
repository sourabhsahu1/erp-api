<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $name
 * @property bool $is_child_enabled
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $regions
 *
 * @package Modules\Hr\Models
 */
class Country extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'is_child_enabled' => 'bool'
	];

	protected $fillable = [
		'name',
		'is_child_enabled'
	];

	public function regions()
	{
		return $this->hasMany(\Modules\Hr\Models\Region::class);
	}
}
