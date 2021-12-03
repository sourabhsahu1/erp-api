<?php

namespace Modules\Appraisal\Entities;

use Illuminate\Database\Eloquent\Model;

class employeeAppraisals extends Model
{
    protected $fillable = [
        'supervisors_fileno',
        'fileno',
        'fullname',
        'dob',
        'department',
        'designation',
        'qualification',
        'doa',
        'rank',
        'rankdate',
        'actingappointment',
        'courseundertaken',
        'absentdays',
        'jobduties',
        'extraduties',
        'isCompleted',
    ];
}
