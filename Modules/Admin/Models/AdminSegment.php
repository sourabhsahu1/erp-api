<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 28 Apr 2020 05:51:12 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AdminSegment
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_At
 * @property string $combined_code
 * @property string $individual_code
 * @property int $max_level
 * @property int $parent_id
 *
 * @package Modules\Admin\Models
 */
class AdminSegment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'max_level' => 'int',
		'parent_id' => 'int'
	];

	protected $dates = [
		'updated_At'
	];

	protected $fillable = [
		'name',
		'updated_At',
		'combined_code',
		'individual_code',
		'max_level',
		'parent_id'
	];

    public function sub_categories()
    {
        return $this->children()->with('sub_categories');
    }

    public function children()
    {
        return $this->hasMany(AdminSegment::class, 'parent_id');
    }

}
