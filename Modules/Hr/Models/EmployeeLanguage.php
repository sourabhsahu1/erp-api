<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:18:53 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeLanguage
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $language_id
 * @property string $written_proficiency
 * @property string $spoken_proficiency
 * @property string $certification
 * @property string $description
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\Language $language
 *
 * @package Modules\Hr\Models
 */
class EmployeeLanguage extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'hr_employee_languages';
	protected $casts = [
		'employee_id' => 'int',
		'language_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'language_id',
		'written_proficiency',
		'spoken_proficiency',
		'certification',
		'description'
	];

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function language()
	{
		return $this->belongsTo(\Modules\Hr\Models\Language::class, 'language_id');
	}
}
