<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 May 2020 06:30:46 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Marriage
 * 
 * @property int $id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Marriage extends Eloquent
{
	protected $table = "hr_marriage";

	protected $fillable = [
		'status'
	];
}
