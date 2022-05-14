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
 * @property string $title
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
		'title',
        'is_active'
	];

	public function leave_group_members()
    {
        return $this->hasMany(\Modules\Hr\Models\LeaveGroupMember::class, 'leave_group_id');
    }
}
