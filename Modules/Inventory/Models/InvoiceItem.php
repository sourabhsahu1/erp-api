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
 * @property string $description
 * @property int $unit_price
 * @property int $unit_cost
 * @property int $selling_price
 * @property int $quantity
 * @property int $available_balance
 * @property string $account_code
 * @property string $on_order
 * @property string $re_order_quantity
 * @property string $deleted_at
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
        'measurement_id' => 'int',
        'unit_price' => 'int',
        'unit_cost' => 'int',
        'selling_price' => 'int',
        'available_balance' => 'int',
        'quantity' => 'int'
    ];

    protected $table = "inventory_invoice_items";

    protected $fillable = [
        'store_id',
        'item_id',
        'invoice_id',
        'measurement_id',
        'description',
        'unit_price',
        'unit_cost',
        'selling_price',
        'available_balance',
        'quantity',
        'account_code',
        'on_order',
        're_order_quantity'
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

    public function lifo()
    {
        return $this->hasMany(\Modules\Inventory\Models\ItemsLifoCost::class, 'invoice_item_id');
    }

    public function fifo()
    {
        return $this->hasMany(\Modules\Inventory\Models\ItemsFifoCost::class, 'invoice_item_id');
    }

    public function avg()
    {
        return $this->hasMany(\Modules\Inventory\Models\ItemsAvgCost::class, 'invoice_item_id');
    }
}
