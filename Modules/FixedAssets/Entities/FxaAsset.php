<?php

namespace Modules\FixedAssets\Entities;

use Modules\Hr\Models\File;
use Reliese\Database\Eloquent\Model as Eloquent;

class FxaAsset extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
        'custodian' => 'int',
        'acquisition_cost' => 'int',
        'acquisition_cost_deprecated' => 'int',
        'is_depreciation_over' => 'bool',
        'is_installed' => 'bool',
        'is_commissioned' => 'bool',
        'is_decommissioned' => 'bool',
        'is_disposed' => 'bool',
        'disposal_price' => 'int',
        'begin_accum_depr' => 'int',
        'expected_life' => 'int',
        'salvage_value' => 'int',
        'fxa_depreciation_method_id' => 'int',
        'fxa_category_id' => 'int',
        'fxa_status_id' => 'int',
        'admin_segment_id' => 'int',
        'economic_segment_id' => 'int',
        'programme_segment_id' => 'int',
        'fund_segment_id' => 'int',
        'functional_segment_id' => 'int',
        'geo_code_segment_id' => 'int',
        't_date' => 'int',
        'login_id' => 'int',
        'nmrl_location' => 'int',
        'qty' => 'int',
        'file_id' => 'int',
        'comments' => 'int'
    ];

    protected $dates = [
        'date_manufactured',
        'date_acquired',
        'commissioned',
        'decommissioned',
        'date_installed',
        'date_commissioned',
        'date_de_commissioned',
        'date_disposed'
    ];

    protected $fillable = [
        'asset_no',
        'title',
        'custodian',
        'make',
        'model',
        'model_no',
        'oem_serial_no',
        'oem_bar_code_no',
        'date_manufactured',
        'date_acquired',
        'acquisition_cost',
        'acquisition_cost_deprecated',
        'is_depreciation_over',
        'is_installed',
        'is_commissioned',
        'is_decommissioned',
        'is_disposed',
        'installed',
        'commissioned',
        'decommissioned',
        'date_installed',
        'date_commissioned',
        'date_de_commissioned',
        'date_disposed',
        'disposal_price',
        'begin_accum_depr',
        'expected_life',
        'salvage_value',
        'supplier_invoice',
        'supplier_name',
        'supplier_contact',
        'fxa_depreciation_method_id',
        'fxa_category_id',
        'fxa_status_id',
        'admin_segment_id',
        'economic_segment_id',
        'programme_segment_id',
        'fund_segment_id',
        'functional_segment_id',
        'geo_code_segment_id',
        'remark',
        't_date',
        'login_id',
        'nmrl_location',
        'qty',
        'file_id',
        'comments'
    ];

    public function program_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'programme_segment_id');
    }

    public function economic_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
    }

    public function functional_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'functional_segment_id');
    }

    public function geo_code_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'geo_code_segment_id');
    }

    public function admin_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'admin_segment_id');
    }

    public function fund_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fund_segment_id');
    }

    public function category()
    {
        return $this->belongsTo(\Modules\FixedAssets\Entities\FxaCategory::class, 'fxa_category_id');
    }

    public function depr_method()
    {
        return $this->belongsTo(\Modules\FixedAssets\Entities\FxaDepreciationMethod::class);
    }

    public function status()
    {
        return $this->belongsTo(\Modules\FixedAssets\Entities\FxaStatus::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function latest_deployment()
    {
        return $this->hasOne(\Modules\FixedAssets\Entities\FxaDeployment::class)
            ->orderBy('created_at', 'desc');
    }
    public function depreciation_details()
    {
        return $this->hasMany(\Modules\FixedAssets\Entities\FxaDepreciationDetail::class,'fxa_assets_id')->orderBy('created_at','desc');
    }
}
