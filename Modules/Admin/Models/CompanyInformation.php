<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 12 Oct 2020 07:59:39 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CompanyInformation
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $company_settings
 *
 * @package Modules\Admin\Models
 */
class CompanyInformation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'company_information';

	protected $fillable = [
		'name',
		'address',
		'email',
		'phone'
	];

	public function company_settings()
	{
		return $this->hasMany(\Modules\Admin\Models\CompanySetting::class);
	}
}
