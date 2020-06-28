<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 26 Jun 2020 09:18:09 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ItemTax
 * 
 * @property int $id
 * @property int $item_id
 * @property int $tax_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Inventory\Models\Item $inventory_item
 * @property \Modules\Admin\Models\Tax $admin_tax
 *
 * @package Modules\Inventory\Models
 */
class ItemTax extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = 'inventory_item_taxes';
	protected $casts = [
		'item_id' => 'int',
		'tax_id' => 'int'
	];

	protected $fillable = [
		'item_id',
		'tax_id'
	];

	public function item()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Item::class, 'item_id');
	}

	public function tax()
	{
		return $this->belongsTo(\Modules\Admin\Models\Tax::class, 'tax_id');
	}
}
