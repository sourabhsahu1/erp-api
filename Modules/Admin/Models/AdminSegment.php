<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 28 Apr 2020 11:11:43 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Create
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_At
 * @property string $combined_code
 * @property string $individual_code
 * @property int $max_level
 * @property int $parent_id
 * @property int $character_count
 *
 * @package Modules\Admin\Models
 */
class AdminSegment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'max_level' => 'int',
		'parent_id' => 'int',
		'character_count' => 'int'
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
		'parent_id',
		'character_count'
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
