<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:17:07 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeAddress
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $address_type_id
 * @property int $country_id
 * @property int $region_id
 * @property int $state_id
 * @property int $lga_id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property string $zip_code
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\AddressType $address_type
 * @property \Modules\Hr\Models\Country $country
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\Lga $lga
 * @property \Modules\Hr\Models\Region $region
 * @property \Modules\Hr\Models\State $state
 *
 * @package Modules\Hr\Models
 */
class EmployeeAddress extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = 'hr_employee_addresses';
	protected $casts = [
		'employee_id' => 'int',
		'address_type_id' => 'int',
		'country_id' => 'int',
		'region_id' => 'int',
		'state_id' => 'int',
		'lga_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'address_type_id',
		'country_id',
		'region_id',
		'state_id',
		'lga_id',
		'address_line_1',
		'address_line_2',
		'city',
		'zip_code'
	];

	public function address_type()
	{
		return $this->belongsTo(\Modules\Hr\Models\AddressType::class, 'address_type_id');
	}

	public function country()
	{
		return $this->belongsTo(\Modules\Hr\Models\Country::class);
	}

	public function employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
	}

	public function lga()
	{
		return $this->belongsTo(\Modules\Hr\Models\Lga::class);
	}

	public function region()
	{
		return $this->belongsTo(\Modules\Hr\Models\Region::class);
	}

	public function state()
	{
		return $this->belongsTo(\Modules\Hr\Models\State::class);
	}
}
