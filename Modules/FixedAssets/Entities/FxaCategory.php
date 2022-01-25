<?php

namespace Modules\FixedAssets\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

class FxaCategory extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
        'fixed_asset_acct_id' => 'int',
        'accum_depr_acct_id' => 'int',
        'depr_exps_acct_id' => 'int',
        'next_asset_no' => 'int',
        'parent_id' => 'int',
        'ref_no_to_root_node' => 'int',
        'is_editable' => 'bool'
    ];

    protected $fillable = [
        'title',
        'depreciation_method_id',
        'depreciation_rate',
        'fixed_asset_acct_id',
        'accum_depr_acct_id',
        'depr_exps_acct_id',
        'asset_no_prefix_line',
        'asset_no_prefix_full',
        'next_asset_no',
        'parent_id',
        'ref_no_to_root_node',
        'is_parent',
        'is_editable',
        'level_no'
    ];

    public function fixed_asset_acct()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fixed_asset_acct_id');
    }

    public function accum_depr_acct()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'accum_depr_acct_id');
    }

    public function depr_exps_acct()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'depr_exps_acct_id');
    }


    public function parent()
    {
        return $this->belongsTo(\Modules\FixedAssets\Entities\FxaCategory::class, 'parent_id');
    }

    public function fxa_assets()
    {
        return $this->hasMany(\Modules\FixedAssets\Entities\FxaAsset::class);
    }

    public function children()
    {
        return $this->hasMany(\Modules\FixedAssets\Entities\FxaCategory::class, 'parent_id');
    }

    public function sub_categories()
    {
        return $this->children()->with('sub_categories');
    }
}
