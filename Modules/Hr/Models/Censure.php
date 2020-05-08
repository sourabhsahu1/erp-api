<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 25 Apr 2020 10:26:00 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Censure
 * 
 * @property int $id
 * @property string $name
 * @property boolean $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Censure extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "hr_censures";

    protected $casts = [
        'is_active' => 'bool',
    ];

	protected $fillable = [
		'name',
        'is_active'
	];
}
