<?php

namespace Modules\FixedAssets\Http\Requests\FixedAssets;

use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'asset_no' => 'required',
            'title'  => 'required',
            'custodian' => 'required',
            'make' => 'required',
            'model' => 'required',
            'model_no' => 'required',
            'oem_serial_no' => 'required',
            'oem_bar_code_no' => 'required',
            'date_manufactured' => 'required',
            'date_acquired' => 'required',
            'acquisition_cost' => 'required',
            'installed' => 'required',
            'commissioned' => 'required',
            'decommissioned' => 'required',
            'date_installed' => 'required',
            'date_commissioned' => 'required',
            'date_de_commissioned' => 'required',
            'date_disposed' => 'required',
            'disposal_price' => 'required',
            'begin_accum_depr' => 'required',
            'xptd_life_yrs' => 'required',
            'salvage_value' => 'required',
            'supplier_invoice' => 'required',
            'supplier_name' => 'required',
            'supplier_contact' => 'required',
            'fxa_depr_method_id' => 'required',
            'fxa_category_id' => 'required',
            'fxa_status_id' => 'required',
            'admin_segment_id' => 'required',
            'economic_segment_id' => 'required',
            'programme_segment_id' => 'required',
            'fund_segment_id' => 'required',
            'functional_segment_id' => 'required',
            'geo_code_segment_id' => 'required',
            'remark' => 'required',
            't_date' => 'required',
            'login_id' => 'required',
            'nmrl_location' => 'required',
            'qty' => 'required',
            'file_id' => 'required',
            'comments' => 'required'
        ];
    }
}
