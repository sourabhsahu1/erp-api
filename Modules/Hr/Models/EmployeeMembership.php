<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:19:02 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeMembership
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $membership_id
 * @property string $membership_registration_number
 * @property string $membership_rank
 * @property \Carbon\Carbon $join_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\Membership $membership
 *
 * @package Modules\Hr\Models
 */
class EmployeeMembership extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = '';
	protected $casts = [
		'employee_id' => 'int',
		'membership_id' => 'int'
	];

	protected $dates = [
		'join_at'
	];

	protected $fillable = [
		'employee_id',
		'membership_id',
		'membership_registration_number',
		'membership_rank',
		'join_at'
	];

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function membership()
	{
		return $this->belongsTo(\Modules\Hr\Models\Membership::class, 'membership_id');
	}
}
