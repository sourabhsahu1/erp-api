<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 13 Dec 2021 18:39:20 +0000.
 */

namespace Modules\FixedAssets\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FxaDepreciationDetail
 *
 * @property int $id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Treasury\Models
 */
class FxaDepreciationDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
}
