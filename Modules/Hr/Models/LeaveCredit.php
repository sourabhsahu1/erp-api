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
 * @property int $leave_year
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class LeaveCredit extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_leave_credit';

	protected $fillable = [
		'prepared_login_id',
		'staff_id',
		'leave_type_id',
		'due_days',
		'leave_year_id',
		'prepared_v_date',
		'prepared_t_date',
	];

	public function employee()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class,'staff_id', 'id');
    }

	public function leave()
    {
        return $this->hasOne(\Modules\Hr\Models\Leave::class,'id', 'leave_type_id');
    }

	public function leave_year()
    {
        return $this->hasOne(\Modules\Hr\Models\LeaveYear::class,'id', 'leave_year_id');
    }
}
