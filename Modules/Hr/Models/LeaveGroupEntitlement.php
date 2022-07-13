<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 29 Apr 2020 22:07:47 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LeaveGroupMember
 * 
 * @property int $id
 * @property string $leave_group_id
 * @property string $leave_type_id
 * @property integer $due_days
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class LeaveGroupEntitlement extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_leave_group_entitlements';

    protected $casts = [
    ];
	protected $fillable = [
		'leave_group_id',
		'leave_type_id',
		'due_days',
	];

	public function leave_group()
    {
        return $this->hasOne(\Modules\Hr\Models\LeaveGroup::class,'id', 'leave_group_id');
    }
	public function leave()
    {
        return $this->hasOne(\Modules\Hr\Models\Leave::class,'id', 'leave_type_id');
    }
}
