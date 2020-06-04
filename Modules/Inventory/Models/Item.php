<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 04 Jun 2020 08:35:40 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryItem
 * 
 * @property int $id
 * @property int $category_id
 * @property int $measurement_id
 * @property string $description
 * @property string $part_number
 * @property bool $is_physical_quantity
 * @property bool $is_charged_vat
 * @property bool $is_charged_other_tax
 * @property int $unit_price
 * @property int $sales_commission
 * @property int $lead_days
 * @property int $reorder_quantity
 * @property int $minimum_quantity
 * @property int $maximum_quantity
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Inventory\Models\Item $inventory_item
 * @property \Modules\Inventory\Models\Measurement $inventory_measurement
 * @property \Illuminate\Database\Eloquent\Collection $inventory_items
 *
 * @package Modules\Hr\Models
 */
class Item extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "inventory_items";
	protected $casts = [
		'category_id' => 'int',
		'measurement_id' => 'int',
		'is_physical_quantity' => 'bool',
		'is_charged_vat' => 'bool',
		'is_charged_other_tax' => 'bool',
		'unit_price' => 'int',
		'sales_commission' => 'int',
		'lead_days' => 'int',
		'reorder_quantity' => 'int',
		'minimum_quantity' => 'int',
		'maximum_quantity' => 'int'
	];

	protected $fillable = [
		'category_id',
		'measurement_id',
		'description',
		'part_number',
		'is_physical_quantity',
		'is_charged_vat',
		'is_charged_other_tax',
		'unit_price',
		'sales_commission',
		'lead_days',
		'reorder_quantity',
		'minimum_quantity',
		'maximum_quantity'
	];

	public function inventory_item()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Item::class, 'category_id');
	}

	public function inventory_measurement()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Measurement::class, 'measurement_id');
	}

	public function inventory_items()
	{
		return $this->hasMany(\Modules\Inventory\Models\Item::class, 'category_id');
	}
}
