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
 * @property string $staff_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class LeaveGroupMember extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_leave_group_member';

    protected $casts = [
    ];
	protected $fillable = [
		'leave_group_id',
		'staff_id'
	];

	public function user()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'created_by_id');
	}

	public function leave_group()
    {
        return $this->hasOne(\Modules\Hr\Models\LeaveGroup::class,'id', 'leave_group_id');
    }
	public function employee()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class,'staff_id', 'id');
    }
}
