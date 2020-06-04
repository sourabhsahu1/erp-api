<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 04 Jun 2020 08:32:21 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryMeasurement
 * 
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $inventory_items
 *
 * @package Modules\Hr\Models
 */
class Measurement extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = "inventory_measurements";

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'is_active'
	];

	public function inventory_items()
	{
		return $this->hasMany(\Modules\Inventory\Models\Item::class, 'measurement_id');
	}
}
