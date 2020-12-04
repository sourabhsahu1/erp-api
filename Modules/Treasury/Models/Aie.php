<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Nov 2020 15:15:05 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TreasuryAie
 *
 * @property int $id
 * @property string $aie_number
 * @property \Carbon\Carbon $date_issued
 * @property string $narration
 * @property int $fund_segment_id
 * @property int $admin_segment_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Admin\Models\AdminSegment $fund_segment
 * @property \Illuminate\Database\Eloquent\Collection $aie_economic_balances
 *
 * @package Modules\Treasury\Models
 */
class Aie extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'treasury_aies';
    protected $casts = [
        'fund_segment_id' => 'int',
        'admin_segment_id' => 'int'
    ];

    protected $dates = [
        'date_issued'
    ];

    protected $fillable = [
        'aie_number',
        'date_issued',
        'narration',
        'fund_segment_id',
        'admin_segment_id'
    ];

    public function fund_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fund_segment_id');
    }

    public function aie_economic_balances()
    {
        return $this->hasMany(\Modules\Treasury\Models\AieEconomicBalance::class, 'aie_id');
    }
}
