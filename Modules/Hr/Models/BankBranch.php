<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 08:42:35 +0000.
 */

namespace Modules\Hr\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BankBranch
 * 
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $sort_code
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $is_active
 * @property int $bank_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Bank $hr_bank
 *
 * @package Modules\Hr\Models
 */
class BankBranch extends Eloquent
{
    use SoftDeletes;
    protected $table = 'hr_bank_branches';
	protected $casts = [
		'bank_id' => 'int'
	];

	protected $fillable = [
		'name',
		'bank_id',
        'country',
        'sort_code',
        'address',
        'city',
        'state',
        'is_active'
	];

	public function hr_bank()
	{
		return $this->belongsTo(\Modules\Hr\Models\Bank::class, 'bank_id');
	}
}
