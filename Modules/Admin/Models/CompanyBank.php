<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 12 Jun 2020 13:51:59 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CompanyBank
 * 
 * @property int $id
 * @property int $company_id
 * @property int $bank_id
 * @property int $branch_id
 * @property string $bank_account_number
 * @property string $type_of_bank_account
 * @property bool $is_authorised
 * @property \Carbon\Carbon $date
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\Bank $bank
 * @property \Modules\Hr\Models\BankBranch $bank_branch
 * @property \Modules\Admin\Models\Company $company
 *
 * @package Modules\Inventory\Models
 */
class CompanyBank extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = 'admin_company_banks';
	protected $casts = [
		'company_id' => 'int',
		'bank_id' => 'int',
		'branch_id' => 'int',
		'is_authorised' => 'bool'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'company_id',
		'bank_id',
		'branch_id',
		'bank_account_number',
		'type_of_bank_account',
		'is_authorised',
		'date'
	];

	public function bank()
	{
		return $this->belongsTo(\Modules\Hr\Models\Bank::class, 'bank_id');
	}

	public function bank_branch()
	{
		return $this->belongsTo(\Modules\Hr\Models\BankBranch::class, 'branch_id');
	}

	public function company()
	{
		return $this->belongsTo(\Modules\Admin\Models\Company::class, 'company_id');
	}
}
