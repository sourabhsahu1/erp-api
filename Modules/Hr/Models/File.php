<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Apr 2020 14:56:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class File
 * 
 * @property int $id
 * @property string $name
 * @property string $local_path
 * @property string $type
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $employees
 *
 * @package App\Models
 */
class File extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $fillable = [
		'name',
		'local_path',
		'type'
	];

	public function employees()
	{
		return $this->hasMany(\App\Models\Employee::class, 'profile_image_id');
	}
}
