<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 13 Dec 2021 18:38:24 +0000.
 */

namespace Modules\FixedAssets\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FxaCategory
 *
 * @property int $id
 * @property string $title
 * @property int $fixed_asset_acct_id
 * @property int $accum_depr_acct_id
 * @property int $depr_exps_acct_id
 * @property string $asset_no_prefix_line
 * @property string $asset_no_prefix_full
 * @property int $next_asset_no
 * @property int $parent_id
 * @property int $ref_no_to_root_node
 * @property string $is_parent
 * @property bool $is_editable
 * @property string $level_no
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\FixedAssets\Entities\FxaCategory $fxa_category
 * @property \Illuminate\Database\Eloquent\Collection $fxa_assets
 * @property \Illuminate\Database\Eloquent\Collection $fxa_categories
 *
 * @package Modules\Treasury\Models
 */
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
