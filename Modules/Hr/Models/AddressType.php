<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 07:33:19 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AddressType
 * 
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class AddressType extends Eloquent
{

    protected $table = 'hr_address_types';
	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'is_active'
	];
}
