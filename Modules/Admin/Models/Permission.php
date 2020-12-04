<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 Sep 2020 19:03:25 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permission
 *
 * @property int $id
 * @property string $name
 * @property string $entity_name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $roles
 *
 * @package Modules\Admin\Models
 */
class Permission extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $fillable = [
		'name',
		'entity_name',
        'module'
	];

	public function roles()
	{
		return $this->belongsToMany(\Modules\Hr\Models\Role::class, 'role_permissions')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
