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
class LeaveBalanceReport extends Eloquent
{
	protected $table = 'hr_view_leave_balance';

	protected $fillable = [
		"empId",
		'FullName',
		'personal_file_number',
		'leave_type_id',
		'leave_credit_id',
		'due_days',
		'leave_credit_days_utilised',
		'leave_credit_balance_due',
	];
	public function leave()
	{
		return $this->hasOne(\Modules\Hr\Models\Leave::class, 'id', 'leave_type_id');
	}

	public function LeaveCredit()
	{
		return $this->hasOne(\Modules\Hr\Models\LeaveCredit::class, 'id', 'leave_credit_id');
	}

	public function staff()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class,'empId', 'id');
    }
}
