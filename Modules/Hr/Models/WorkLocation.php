<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 Apr 2020 22:23:07 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WorkLocation
 * 
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property boolean $is_child_enabled
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Hr\Models\WorkLocation $hr_work_location
 * @property \Illuminate\Database\Eloquent\Collection $hr_work_locations
 *
 * @package Modules\Hr\Models
 */
class WorkLocation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = 'hr_work_locations';

    protected $casts = [
        'parent_id' => 'int',
        'is_child_enabled' => 'bool'
    ];

    protected $fillable = [
        'parent_id',
        'name',
        'is_child_enabled'
    ];

	public function hr_work_location()
	{
		return $this->belongsTo(\Modules\Hr\Models\WorkLocation::class, 'parent_id');
	}

	public function hr_work_locations()
	{
		return $this->hasMany(\Modules\Hr\Models\WorkLocation::class, 'parent_id');
	}

    public function sub_categories()
    {
        return $this->children()->with('sub_categories');
    }

    public function children()
    {
        return $this->hasMany(WorkLocation::class, 'parent_id');
    }
}
