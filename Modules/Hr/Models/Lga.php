<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Lga
 * 
 * @property int $id
 * @property string $name
 * @property int $state_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\State $state
 * @property \Illuminate\Database\Eloquent\Collection $employees
 *
 * @package Modules\Hr\Models
 */
class Lga extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'state_id' => 'int'
	];

	protected $fillable = [
		'name',
		'state_id'
	];

	public function state()
	{
		return $this->belongsTo(\Modules\Hr\Models\State::class);
	}

	public function employees()
	{
		return $this->hasMany(\Modules\Hr\Models\Employee::class);
	}
}
