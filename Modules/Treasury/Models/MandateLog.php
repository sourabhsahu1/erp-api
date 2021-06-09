<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Jun 2021 14:50:22 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MandateLog
 *
 * @property int $id
 * @property int $mandate_id
 * @property string $previous_status
 * @property string $current_status
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @property \Modules\Treasury\Models\Mandate $treasury_mandate
 *
 * @package Modules\Treasury\Models
 */
class MandateLog extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'mandate_id' => 'int',
		'admin_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'mandate_id',
		'previous_status',
		'current_status',
		'date',
        'admin_id'
	];

	public function treasury_mandate()
	{
		return $this->belongsTo(\Modules\Treasury\Models\Mandate::class, 'mandate_id');
	}
}
