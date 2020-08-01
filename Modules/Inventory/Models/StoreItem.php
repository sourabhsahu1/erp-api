<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 30 Jul 2020 14:02:35 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryStoreItem
 * 
 * @property int $id
 * @property int $store_id
 * @property int $item_id
 * @property int $available_quantity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Inventory\Models\Item $inventory_item
 * @property \Modules\Inventory\Models\Store $inventory_store
 *
 * @package Modules\Inventory\Models
 */
class StoreItem extends Eloquent
{
	protected $casts = [
		'store_id' => 'int',
		'item_id' => 'int',
		'available_quantity' => 'int'
	];

	protected $fillable = [
		'store_id',
		'item_id',
		'available_quantity'
	];

	protected $table = 'inventory_store_items';
	public function inventory_item()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Item::class, 'item_id');
	}

	public function inventory_store()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Store::class, 'store_id');
	}
}
