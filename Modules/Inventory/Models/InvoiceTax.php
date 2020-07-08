<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 10 Jun 2020 09:24:47 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryInvoiceTax
 * 
 * @property int $id
 * @property int $invoice_id
 * @property int $item_id
 * @property float $tax
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Inventory\Models\InvoiceDetail $invoice_detail
 * @property \Modules\Inventory\Models\Item $item
 *
 * @package Modules\Inventory\Models
 */
class InvoiceTax extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;


    protected $table = "inventory_invoice_taxes";
	protected $casts = [
		'invoice_id' => 'int',
        'item_id' => 'int',
        'tax_id' => 'int',
		'tax' => 'float'
	];

	protected $fillable = [
		'invoice_id',
        'item_id',
        'tax_id',
		'tax'
	];

	public function invoice_detail()
	{
		return $this->belongsTo(\Modules\Inventory\Models\InvoiceDetail::class, 'invoice_id');
	}

    public function item()
    {
        return $this->belongsTo(\Modules\Inventory\Models\Item::class, 'item_id');
    }
}
