<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Region
 * 
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property boolean $is_active
 * @property bool $is_child_enabled
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Country $country
 * @property \Illuminate\Database\Eloquent\Collection $states
 *
 * @package Modules\Hr\Models
 */
class Region extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
		'country_id' => 'int',
		'is_child_enabled' => 'bool',
        'is_active' => 'bool',
	];

    protected $fillable = [
		'name',
		'country_id',
		'is_child_enabled',
        'is_active'
	];

	public function country()
	{
		return $this->belongsTo(\Modules\Hr\Models\Country::class);
	}

	public function states()
	{
		return $this->hasMany(\Modules\Hr\Models\State::class);
	}
}
