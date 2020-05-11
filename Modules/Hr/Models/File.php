<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Apr 2020 13:56:49 +0000.
 */

namespace Modules\Hr\Models;

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
 * @package Modules\Hr\Models
 */
class File extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'name',
        'local_path',
        'type'
    ];

    const  FILE_USER_IMAGE = 'USER_IMAGE';

    public function employees()
    {
        return $this->hasMany(\Modules\Hr\Models\Employee::class, 'profile_image_id');
    }
}
