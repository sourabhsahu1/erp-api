<?php

namespace Modules\FixedAssets\Http\Requests\Categories;

use Luezoid\Laravelcore\Requests\BaseRequest;

class Create  extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
//            'fixed_asset_acct_id' => 'required',
//            'accum_depr_acct_id' => 'required',
//            'depr_exps_acct_id' => 'required',
//            'asset_no_prefix_line' => 'required',
//            'asset_no_prefix_full' => 'required',
//            'next_asset_no' => 'sometimes',
//            'parent_id' => 'sometimes',
//            'ref_no_to_root_node' => 'sometimes',
//            'is_parent' => 'required',
//            'is_editable' => 'required',
//            'level_no' => 'required'
        ];
    }

}
