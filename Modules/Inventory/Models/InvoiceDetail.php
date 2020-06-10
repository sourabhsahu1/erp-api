<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 04 Jun 2020 08:35:31 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryCategory
 * 
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property bool $is_active
 * @property bool $is_child_enabled
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Inventory\Models\Category $inventory_category
 * @property \Illuminate\Database\Eloquent\Collection $inventory_categories
 *
 * @package Modules\Hr\Models
 */
class InvoiceDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "inventory_categories";

	protected $casts = [
        'parent_id' => 'int',
        'is_active' => 'bool',
        'is_child_enabled' => 'bool'
	];

	protected $fillable = [
        'name',
        'parent_id',
        'is_active',
        'is_child_enabled'
	];
}
