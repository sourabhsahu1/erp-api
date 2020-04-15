<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 15 Apr 2020 21:37:05 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Skill
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Skill extends Eloquent
{
	protected $fillable = [
		'name'
	];
}
