<?php

namespace Modules\FixedAssets\Http\Requests\Categories;

use Luezoid\Laravelcore\Requests\BaseRequest;

class Update  extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'sometimes',
            'fixed_asset_acct_id' => 'sometimes',
            'accum_depr_acct_id' => 'sometimes',
            'depr_exps_acct_id' => 'sometimes',
            'asset_no_prefix_line' => 'sometimes',
            'asset_no_prefix_full' => 'sometimes',
            'next_asset_no' => 'sometimes',
            'parent_id' => 'sometimes',
            'ref_no_to_root_node' => 'sometimes',
            'is_parent' => 'sometimes',
            'is_editable' => 'sometimes',
            'level_no' => 'sometimes'
        ];
    }

}
