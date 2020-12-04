<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 28 Sep 2020 04:09:22 +0000.
 */

namespace Modules\Finance\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JournalVoucher
 *
 * @property int $id
 * @property string $source_app
 * @property string $batch_number
 * @property \Carbon\Carbon $jv_value_date
 * @property int $fund_segment_id
 * @property string $jv_reference
 * @property string $status
 * @property string $transaction_details
 * @property \Carbon\Carbon $prepared_value_date
 * @property \Carbon\Carbon $prepared_transaction_date
 * @property \Carbon\Carbon $checked_value_date
 * @property \Carbon\Carbon $checked_transaction_date
 * @property \Carbon\Carbon $posted_value_date
 * @property \Carbon\Carbon $posted_transaction_date
 * @property int $prepared_user_id
 * @property int $checked_user_id
 * @property int $posted_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Hr\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $journal_voucher_details
 *
 * @package Modules\Finance\Models
 */
class JournalVoucher extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
        'fund_segment_id' => 'int',
        'prepared_user_id' => 'int',
        'checked_user_id' => 'int',
        'posted_user_id' => 'int',
        'jv_value_date' =>  'datetime:Y-m-d',
        'prepared_value_date' => 'datetime:Y-m-d',
        'prepared_transaction_date' => 'datetime:Y-m-d',
        'checked_value_date' => 'datetime:Y-m-d',
        'checked_transaction_date' => 'datetime:Y-m-d',
        'posted_value_date' => 'datetime:Y-m-d',
        'posted_transaction_date' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    protected $dates = [
        'jv_value_date',
        'prepared_value_date',
        'prepared_transaction_date',
        'checked_value_date',
        'checked_transaction_date',
        'posted_value_date',
        'posted_transaction_date'
    ];

    protected $fillable = [
        'source_app',
        'batch_number',
        'jv_value_date',
        'fund_segment_id',
        'jv_reference',
        'status',
        'transaction_details',
        'prepared_value_date',
        'prepared_transaction_date',
        'checked_value_date',
        'checked_transaction_date',
        'posted_value_date',
        'posted_transaction_date',
        'prepared_user_id',
        'checked_user_id',
        'posted_user_id'
    ];
    public $searchable = ['programmeSegmentId','economicSegmentId'];
    public function fund_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fund_segment_id');
    }

    public function prepared_user()
    {
        return $this->belongsTo(\Modules\Hr\Models\User::class, 'prepared_user_id');
    }

    public function checked_user()
    {
        return $this->belongsTo(\Modules\Hr\Models\User::class, 'checked_user_id');
    }

    public function posted_user()
    {
        return $this->belongsTo(\Modules\Hr\Models\User::class, 'posted_user_id');
    }

    public function journal_voucher_details()
    {
        return $this->hasMany(\Modules\Finance\Models\JournalVoucherDetail::class);
    }
}
