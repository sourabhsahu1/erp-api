<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 28 Apr 2020 11:11:43 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AdminCreateRequest
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
 * * @property int $top_level_child_count
 * @package Modules\Admin\Models
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 */
class AdminSegment extends Eloquent
{
    public $timestamps = false;

    protected $casts = [
        'max_level' => 'int',
        'parent_id' => 'int',
        'character_count' => 'int',
        'is_active' => 'bool',
        'top_level_child_count' => 'int',
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
        'character_count',
        'is_active',
        'top_level_child_count',
        'top_level_id',
    ];

    public function children()
    {
        return $this->getChildes()->with('children');
    }

    public function getChildes()
    {
        return $this->hasMany(AdminSegment::class, 'parent_id');
    }

    public function admin_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'parent_id');
    }

    public function admin_segment_parent()
    {
        return $this->admin_segment()->with('admin_segment_parent');
    }


}
