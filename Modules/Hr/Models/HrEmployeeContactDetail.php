<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 15 May 2020 08:16:38 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class HrEmployeeContactDetail
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $country_id
 * @property int $region_id
 * @property int $state_id
 * @property int $lga_id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property string $zip_code
 * @property int $other_country_id
 * @property int $other_region_id
 * @property int $other_state_id
 * @property int $other_lga_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Country $country
 * @property \Modules\Hr\Models\HrEmployee $hr_employee
 * @property \Modules\Hr\Models\Lga $lga
 * @property \Modules\Hr\Models\Region $region
 * @property \Modules\Hr\Models\State $state
 *
 * @package Modules\Hr\Models
 */
class HrEmployeeContactDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'employee_id' => 'int',
		'country_id' => 'int',
		'region_id' => 'int',
		'state_id' => 'int',
		'lga_id' => 'int',
		'other_country_id' => 'int',
		'other_region_id' => 'int',
		'other_state_id' => 'int',
		'other_lga_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'country_id',
		'region_id',
		'state_id',
		'lga_id',
		'address_line_1',
		'address_line_2',
		'city',
		'zip_code',
		'other_country_id',
		'other_region_id',
		'other_state_id',
		'other_lga_id'
	];

	public function country()
	{
		return $this->belongsTo(\Modules\Hr\Models\Country::class, 'other_country_id');
	}

	public function hr_employee()
	{
		return $this->belongsTo(\Modules\Hr\Models\HrEmployee::class, 'employee_id');
	}

	public function lga()
	{
		return $this->belongsTo(\Modules\Hr\Models\Lga::class, 'other_lga_id');
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
