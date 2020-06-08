<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Jun 2020 11:28:00 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tax
 * 
 * @property int $id
 * @property string $name
 * @property float $tax
 * @property bool $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Admin\Models
 */
class Tax extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'admin_taxes';
	protected $casts = [
        'tax' => 'float',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'tax',
		'is_active'
	];
}
