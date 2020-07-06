<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 29 Jun 2020 14:27:43 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ItemsFifoCost
 * 
 * @property int $id
 * @property int $item_id
 * @property int $invoice_id
 * @property int $quantity
 * @property int $available_quantity
 * @property int $price
 * @property float $fifo_cost
 * @property bool $is_active
 * @property float $selling_price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Inventory\Models\InvoiceDetail $inventory_invoice_detail
 * @property \Modules\Inventory\Models\Item $inventory_item
 *
 * @package Modules\Inventory\Models
 */
class ItemsFifoCost extends Eloquent
{
	protected $table = 'items_fifo_cost';

	protected $casts = [
		'item_id' => 'int',
		'invoice_id' => 'int',
		'quantity' => 'int',
		'available_quantity' => 'int',
		'price' => 'int',
        'is_active' => 'bool',
		'fifo_cost' => 'float',
		'selling_price' => 'float'
	];

	protected $fillable = [
		'item_id',
		'invoice_id',
		'quantity',
		'available_quantity',
		'price',
        'type',
        'is_active',
		'fifo_cost',
		'selling_price'
	];

    public function inventory_invoice_detail()
    {
        return $this->belongsTo(\Modules\Inventory\Models\InvoiceDetail::class, 'invoice_id');
    }

    public function inventory_item()
    {
        return $this->belongsTo(\Modules\Inventory\Models\Item::class, 'item_id');
    }
}
