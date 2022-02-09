<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 13 Dec 2021 18:38:49 +0000.
 */

namespace Modules\FixedAssets\Entities;

use Modules\Hr\Models\File;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FxaAsset
 *
 * @property int $id
 * @property string $asset_no
 * @property string $title
 * @property int $custodian
 * @property string $make
 * @property string $model
 * @property string $model_no
 * @property string $oem_serial_no
 * @property string $oem_bar_code_no
 * @property \Carbon\Carbon $date_manufactured
 * @property \Carbon\Carbon $date_acquired
 * @property int $acquisition_cost
 * @property bool $installed
 * @property \Carbon\Carbon $commissioned
 * @property \Carbon\Carbon $decommissioned
 * @property \Carbon\Carbon $date_installed
 * @property \Carbon\Carbon $date_commissioned
 * @property \Carbon\Carbon $date_de_commissioned
 * @property \Carbon\Carbon $date_disposed
 * @property int $disposal_price
 * @property int $begin_accum_depr
 * @property int $expected_life
 * @property int $salvage_value
 * @property string $supplier_invoice
 * @property string $supplier_name
 * @property string $supplier_contact
 * @property int $fxa_depr_method_id
 * @property int $fxa_category_id
 * @property int $fxa_status_id
 * @property int $admin_segment_id
 * @property int $economic_segment_id
 * @property int $programme_segment_id
 * @property int $fund_segment_id
 * @property int $functional_segment_id
 * @property int $geo_code_segment_id
 * @property int $remark
 * @property int $t_date
 * @property int $login_id
 * @property int $nmrl_location
 * @property int $qty
 * @property int $file_id
 * @property int $comments
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\FixedAssets\Entities\FxaCategory $fxa_category
 * @property \Modules\FixedAssets\Entities\FxaDeprecationMethod $fxa_depr_method
 * @property \Modules\FixedAssets\Entities\FxaStatus $fxa_status
 *
 * @package Modules\Treasury\Models
 */
class FxaAsset extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'custodian' => 'int',
		'acquisition_cost' => 'int',
		'installed' => 'bool',
		'disposal_price' => 'int',
		'begin_accum_depr' => 'int',
		'expected_life' => 'int',
		'salvage_value' => 'int',
		'fxa_depr_method_id' => 'int',
		'fxa_category_id' => 'int',
		'fxa_status_id' => 'int',
		'admin_segment_id' => 'int',
		'economic_segment_id' => 'int',
		'programme_segment_id' => 'int',
		'fund_segment_id' => 'int',
		'functional_segment_id' => 'int',
		'geo_code_segment_id' => 'int',
		'remark' => 'int',
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
		'fxa_depr_method_id',
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
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'program_segment_id');
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
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaCategory::class);
	}

	public function depr_method()
	{
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaDeprecationMethod::class);
	}

	public function status()
	{
		return $this->belongsTo(\Modules\FixedAssets\Entities\FxaStatus::class);
	}

	public function file()
	{
		return $this->belongsTo(File::class);
	}

	public function latest_deployment() {
        return $this->hasOne(\Modules\FixedAssets\Entities\FxaDeployment::class)
            ->orderBy('created_at', 'desc');
    }
}
