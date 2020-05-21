<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 May 2020 06:55:38 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Religion
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Religion extends Eloquent
{

    protected $table = "hr_religions";
	protected $fillable = [
		'name'
	];
}
