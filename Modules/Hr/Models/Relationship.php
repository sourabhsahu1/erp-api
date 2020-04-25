<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 25 Apr 2020 10:29:08 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Relationship
 * 
 * @property int $id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class Relationship extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = "hr_relationships";
	protected $fillable = [
		'name'
	];
}
