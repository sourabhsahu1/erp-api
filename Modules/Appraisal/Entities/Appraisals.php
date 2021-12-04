<?php

namespace Modules\Appraisal\Entities;

use Illuminate\Database\Eloquent\Model;

class appraisals extends Model
{
    protected $fillable = [
        'startDate',
        'endDate',
        'ongoing',
        'purpose',
    ];
}
