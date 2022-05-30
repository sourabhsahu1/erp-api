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
		'approvedHod' => 'bool',
		'approvedHr' => 'bool',
		'request_ready' => 'bool'
	];
	protected $fillable = [
		"leaveRequestId" => "required",
		'daysSpent'=> 'required',
		'preparedVDate',
		'preparedTDate',
		'preparedLoginId',
		'hodStaffId',
		'approvedHodVDate',
		'approvedHodTDate',
		'approvedHodLoginId',
		'approvedHrStaffId',
		'approvedHrVDate',
		'approvedHrTDate',
		'approvedHrLoginId',
		'userRemarks',
		'hodRemarks',
		'HrRemarks',
	];
}
