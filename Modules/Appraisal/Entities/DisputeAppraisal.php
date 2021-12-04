<?php

namespace Modules\Appraisal\Entities;

use Illuminate\Database\Eloquent\Model;

class disputeAppraisal extends Model
{
    protected $fillable = [
        'fileno',
        'emailaddress',
        'dispute',
        'isDisputable',
    ];
}
