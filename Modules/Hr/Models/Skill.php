<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Skill
 * 
 * @property int $id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $job_positions
 *
 * @package Modules\Hr\Models
 */
class Skill extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = "hr_skills";
	protected $fillable = [
		'name'
	];

	public function job_positions()
	{
		return $this->hasMany(\Modules\Hr\Models\JobPosition::class);
	}
}
