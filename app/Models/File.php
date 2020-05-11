<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 May 2019 12:59:21 +0530.
 */

namespace Adapt\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class File
 *
 * @property int $id
 * @property string $name
 * @property string $s3_key
 * @property string $local_path
 * @property string $type
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $error_log_files
 * @property \Illuminate\Database\Eloquent\Collection $file_uploads
 *
 * @package Adapt\Models
 */
class File extends \Luezoid\Laravelcore\Models\File
{
    use \Illuminate\Database\Eloquent\SoftDeletes;


    protected $fillable = [
        'name',
        's3_key',
        'local_path',
        'type'
    ];

}
