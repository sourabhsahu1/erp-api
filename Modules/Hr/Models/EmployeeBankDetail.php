<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:18:05 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeBankDetail
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $bank_id
 * @property int $bank_branch_id
 * @property string $title
 * @property string $number
 * @property string $type
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 *
 * @package Modules\Hr\Models
 */
class EmployeeBankDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;


    protected $table = 'hr_employee_bank_details';
	protected $casts = [
		'employee_id' => 'int',
		'bank_id' => 'int',
		'bank_branch_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'bank_id',
		'bank_branch_id',
		'title',
		'number',
		'type'
	];

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function bank()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'bank_id');
	}

	public function branches()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'bank_branch_id');
	}
}
