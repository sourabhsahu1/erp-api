<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 13 Dec 2021 18:39:10 +0000.
 */

namespace Modules\FixedAssets\Entities;

use Modules\Hr\Models\WorkLocation;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FxaDeployment
 *
 * @property int $id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Treasury\Models
 */
class FxaDeployment extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'fxa_asset_id',
        'custodian_id',
        'value_date',
        'admin_segment_id',
        'location_id',
        'remark',
        'created_by_id'
    ];

    public function admin_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'admin_segment_id');
    }

    public function work_location()
    {
        return $this->belongsTo(WorkLocation::class, 'location_id');
    }

    public function custodian()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'custodian_id');
    }
}
