<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 21 May 2020 06:55:29 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TypeOfAppointment
 * 
 * @property int $id
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Hr\Models
 */
class TypeOfAppointment extends Eloquent
{

    protected $table = "hr_type_of_appointments";
	protected $fillable = [
		'type'
	];
}
