<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:18:16 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeCensure
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $issued_by_id
 * @property int $censure_id
 * @property \Carbon\Carbon $date_issued
 * @property int $file_id
 * @property string $document_type
 * @property string $file_page
 * @property string $summary
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Censure $censure
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\Employee $issued_by
 * @property \Modules\Hr\Models\File $file
 *
 * @package Modules\Hr\Models
 */
class EmployeeCensure extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'hr_employee_censures';
	protected $casts = [
		'employee_id' => 'int',
		'issued_by_id' => 'int',
		'censure_id' => 'int',
		'file_id' => 'int'
	];

	protected $dates = [
		'date_issued'
	];

	protected $fillable = [
		'employee_id',
		'issued_by_id',
		'censure_id',
		'date_issued',
		'file_id',
		'document_type',
		'file_page',
		'summary'
	];

	public function censure()
	{
		return $this->belongsTo(\Modules\Hr\Models\Censure::class, 'censure_id');
	}

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

    public function issued_by()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'issued_by_id');
    }

	public function file()
	{
		return $this->belongsTo(\Modules\Hr\Models\File::class);
	}
}
