<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Oct 2020 13:08:24 +0000.
 */

namespace Modules\Finance\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Budget
 *
 * @property int $id
 * @property int $admin_segment_id
 * @property int $fund_segment_id
 * @property int $economic_segment_id
 * @property int $program_segment_id
 * @property float $x_rate_local
 * @property float $x_rate_to_international
 * @property int $currency_id
 * @property float $budget_amount
 * @property float $previous_year_amount
 * @property float $previous_year_actual_amount
 * @property float $cumulative_previous_year_amount
 * @property float $cumulative_previous_year_actual_amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Admin\Models\AdminSegment $program_segment
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 * @property \Modules\Admin\Models\AdminSegment $fund_segment
 * @property \Modules\Finance\Models\Currency $currency
 * @property \Illuminate\Database\Eloquent\Collection $budget_breakups
 *
 * @package Modules\Finance\Models
 */
class Budget extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'budget';

    protected $casts = [
        'admin_segment_id' => 'int',
        'fund_segment_id' => 'int',
        'economic_segment_id' => 'int',
        'program_segment_id' => 'int',
        'x_rate_local' => 'float',
        'x_rate_to_international' => 'float',
        'currency_id' => 'int',
        'previous_year_amount' => 'float',
        'previous_year_actual_amount' => 'float',
        'cumulative_previous_year_amount' => 'float',
        'cumulative_previous_year_actual_amount' => 'float'
    ];

    protected $fillable = [
        'admin_segment_id',
        'fund_segment_id',
        'economic_segment_id',
        'program_segment_id',
        'x_rate_local',
        'x_rate_to_international',
        'currency_id',
        'budget_amount',
        'previous_year_amount',
        'previous_year_actual_amount',
        'cumulative_previous_year_amount',
        'cumulative_previous_year_actual_amount'
    ];
    public $searchable = ['id','admin_segment_id','fund_segment_id'];

    public function admin_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'admin_segment_id');
    }

    public function economic_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
    }

    public function program_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'program_segment_id');
    }

    public function fund_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fund_segment_id');
    }

    public function currency()
    {
        return $this->belongsTo(\Modules\Finance\Models\Currency::class);
    }

    public function budget_breakups()
    {
        return $this->hasMany(\Modules\Finance\Models\BudgetBreakup::class);
    }
}
