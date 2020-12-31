<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Dec 2020 10:42:24 +0000.
 */

namespace Modules\Finance\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IfrNote
 * 
 * @property int $id
 * @property string $type
 * @property int $economic_segment_id
 * @property int $program_segment_id
 * @property string $note_id
 * @property string $uses_of_fund_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Admin\Models\AdminSegment $economic_segment
 * @property \Modules\Admin\Models\AdminSegment $program_segment
 *
 * @package Modules\Finance\Models
 */
class IfrNote extends Eloquent
{
	protected $casts = [
		'economic_segment_id' => 'int',
		'program_segment_id' => 'int'
	];

	protected $fillable = [
		'type',
		'economic_segment_id',
		'program_segment_id',
		'note_id',
		'uses_of_fund_type'
	];

	public function economic_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
	}
	public function program_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'program_segment_id');
	}
}
