<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 29 Apr 2020 22:07:47 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LeaveGroup
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
class LeaveGroup extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_leave_group';

    protected $casts = [
        'is_active' => 'bool',
    ];
	protected $fillable = [
		'name',
        'is_active'
	];
}
