<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 08:42:27 +0000.
 */

namespace Modules\Hr\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bank
 * 
 * @property int $id
 * @property string $name
 * @property boolean $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $hr_bank_branches
 *
 * @package Modules\Hr\Models
 */
class Bank extends Eloquent
{

    use SoftDeletes;
    protected $table = 'hr_banks';
	protected $fillable = [
		'name',
        'is_active'
	];

	public function hr_bank_branches()
	{
		return $this->hasMany(\Modules\Hr\Models\BankBranch::class, 'bank_id');
	}
}
