<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 12 Oct 2020 07:59:15 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CompanySetting
 * 
 * @property int $id
 * @property int $company_information_id
 * @property string $country
 * @property string $currency
 * @property bool $auto_post
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Admin\Models\CompanyInformation $company_information
 *
 * @package Modules\Inventory\Models
 */
class CompanySetting extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'company_information_id' => 'int',
		'auto_post' => 'bool'
	];

	protected $fillable = [
		'company_information_id',
		'country',
		'currency',
		'auto_post'
	];

	public function company_information()
	{
		return $this->belongsTo(\Modules\Admin\Models\CompanyInformation::class);
	}
}
