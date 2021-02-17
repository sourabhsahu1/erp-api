<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 08 Jan 2021 12:46:05 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mandate
 * 
 * @property int $id
 * @property int $cashbook_id
 * @property int $batch_number
 * @property int $treasury_number
 * @property \Carbon\Carbon $value_date
 * @property string $instructions
 * @property string $status
 * @property int $first_authorised
 * @property \Carbon\Carbon $first_authorised_date
 * @property int $second_authorised
 * @property \Carbon\Carbon $second_authorised_date
 * @property int $prepared
 * @property \Carbon\Carbon $prepared_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Modules\Treasury\Models\Cashbook $cashbook
 * @property \Illuminate\Database\Eloquent\Collection $payment_vouchers
 *
 * @package Modules\Treasury\Models
 */
class Mandate extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;


	protected $table = "treasury_mandates";
	protected $casts = [
		'cashbook_id' => 'int',
		'batch_number' => 'int',
		'treasury_number' => 'int',
		'first_authorised_by' => 'int',
		'second_authorised_by' => 'int',
		'prepared_by' => 'int'
	];

	protected $dates = [
		'value_date',
		'first_authorised_date',
		'second_authorised_date',
		'prepared_date'
	];

	protected $fillable = [
		'cashbook_id',
		'batch_number',
		'treasury_number',
		'value_date',
		'instructions',
		'status',
		'first_authorised_by',
		'first_authorised_date',
		'second_authorised_by',
		'second_authorised_date',
		'prepared_by',
		'prepared_date'
	];

	public function cashbook()
	{
		return $this->belongsTo(\Modules\Treasury\Models\Cashbook::class, 'cashbook_id');
	}


    public function first_authorised()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'first_authorised_by');
    }


    public function second_authorised()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'second_authorised_by');
    }

    public function prepared()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'prepared_by');
    }

	public function payment_vouchers()
	{
		return $this->hasMany(\Modules\Treasury\Models\PaymentVoucher::class, 'mandate_id');
	}
}
