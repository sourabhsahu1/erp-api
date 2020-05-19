<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 May 2020 08:27:29 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AdminSegmentLevelConfig
 * 
 * @property int $id
 * @property string $level
 * @property int $count
 * @property int $admin_segment_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 *
 * @package Modules\Admin\Models
 */
class AdminSegmentLevelConfig extends Eloquent
{
	protected $table = 'admin_segment_level_config';

	protected $casts = [
		'count' => 'int',
		'admin_segment_id' => 'int'
	];

	protected $fillable = [
		'level',
		'count',
		'admin_segment_id'
	];

	public function admin_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class);
	}
}
