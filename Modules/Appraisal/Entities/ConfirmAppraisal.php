<?php

namespace Modules\Appraisal\Entities;

use Illuminate\Database\Eloquent\Model;

class confirmAppraisal extends Model
{
    protected $fillable = [
        'reportconfirmation',
        'agreement',
        'grading',
        'serve',
        'blockfullname',
        'fileno',
        'isAwardable',
    ];
}
