<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Sep 2020 11:03:52 +0000.
 */

namespace Modules\Finance\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $code_currency
 * @property int $country_id
 * @property string $singular_currency_name
 * @property string $plural_currency_name
 * @property string $currency_sign
 * @property string $singular_change_name
 * @property string $plural_change_name
 * @property string $change_sign
 * @property float $month_1
 * @property float $month_2
 * @property float $month_3
 * @property float $month_4
 * @property float $month_5
 * @property float $month_6
 * @property float $month_7
 * @property float $month_8
 * @property float $month_9
 * @property float $month_10
 * @property float $month_11
 * @property float $month_12
 * @property float $previous_year_closing_rate_local
 * @property float $previous_year_closing_rate_international
 * @property bool $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Hr\Models\Country $country
 *
 * @package Modules\Finance\Models
 */
class Currency extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'country_id' => 'int',
		'month_1' => 'float',
		'month_2' => 'float',
		'month_3' => 'float',
		'month_4' => 'float',
		'month_5' => 'float',
		'month_6' => 'float',
		'month_7' => 'float',
		'month_8' => 'float',
		'month_9' => 'float',
		'month_10' => 'float',
		'month_11' => 'float',
		'month_12' => 'float',
		'previous_year_closing_rate_local' => 'float',
		'previous_year_closing_rate_international' => 'float',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'code_currency',
		'country_id',
		'singular_currency_name',
		'plural_currency_name',
		'currency_sign',
		'singular_change_name',
		'plural_change_name',
		'change_sign',
		'month_1',
		'month_2',
		'month_3',
		'month_4',
		'month_5',
		'month_6',
		'month_7',
		'month_8',
		'month_9',
		'month_10',
		'month_11',
		'month_12',
		'previous_year_closing_rate_local',
		'previous_year_closing_rate_international',
		'is_active'
	];

	public function country()
	{
		return $this->belongsTo(\Modules\Hr\Models\Country::class);
	}
}
