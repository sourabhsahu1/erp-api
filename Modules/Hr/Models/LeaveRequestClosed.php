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
class LeaveRequestClosed extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'hr_leave_request_closed';
	protected $casts = [
		'request_ready' => 'bool'
	];
	protected $fillable = [
		"leave_request_id" => "required",
		'days_spent'=> 'required',
		'prepared_v_date',
		'prepared_t_date',
		'prepared_login_id',
		'request_ready',
		'hod_staff_id',
		'approved_hod',
		'approved_hod_v_date',
		'approved_hod_t_date',
		'approved_hod_login_id',
		'approved_hr_staff_id',
		'approved_hr',
		'approved_hr_v_date',
		'approved_hr_t_date',
		'approved_hr_login_id',
		'user_remarks',
		'hod_remarks',
		'hr_remarks',
	];
}
