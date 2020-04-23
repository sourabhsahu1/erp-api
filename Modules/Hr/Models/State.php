<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class State
 * 
 * @property int $id
 * @property string $name
 * @property int $region_id
 * @property bool $is_child_enabled
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Region $region
 * @property \Illuminate\Database\Eloquent\Collection $lgas
 *
 * @package Modules\Hr\Models
 */
class State extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'region_id' => 'int',
		'is_child_enabled' => 'bool'
	];

	protected $fillable = [
		'name',
		'region_id',
		'is_child_enabled'
	];

	public function region()
	{
		return $this->belongsTo(\Modules\Hr\Models\Region::class);
	}

	public function lgas()
	{
		return $this->hasMany(\Modules\Hr\Models\Lga::class);
	}
}
