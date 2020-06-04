<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 04 Jun 2020 08:34:53 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryStore
 * 
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Store extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "inventory_stores";
	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'is_active'
	];
}
