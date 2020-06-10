<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 10 Jun 2020 09:24:54 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryInvoiceItem
 * 
 * @property int $id
 * @property int $store_id
 * @property int $item_id
 * @property int $invoice_id
 * @property int $measurement_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Inventory\Models\InvoiceDetail $invoice_detail
 * @property \Modules\Inventory\Models\Item $inventory_item
 * @property \Modules\Inventory\Models\Measurement $measurement
 * @property \Modules\Inventory\Models\Store $store
 *
 * @package Modules\Inventory\Models
 */
class InvoiceItem extends Eloquent
{
	protected $casts = [
		'store_id' => 'int',
		'item_id' => 'int',
		'invoice_id' => 'int',
		'measurement_id' => 'int'
	];

	protected $fillable = [
		'store_id',
		'item_id',
		'invoice_id',
		'measurement_id'
	];

	public function invoice_detail()
	{
		return $this->belongsTo(\Modules\Inventory\Models\InvoiceDetail::class, 'invoice_id');
	}

	public function inventory_item()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Item::class, 'item_id');
	}

	public function measurement()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Measurement::class, 'measurement_id');
	}

	public function store()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Store::class, 'store_id');
	}
}
