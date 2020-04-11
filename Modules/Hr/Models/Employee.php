<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 11 Apr 2020 15:43:27 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Employee
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Employee extends Eloquent
{
	protected $fillable = [
		'name'
	];
}
