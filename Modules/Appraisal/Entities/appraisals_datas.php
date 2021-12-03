<?php

namespace Modules\Appraisal\Entities;

use Illuminate\Database\Eloquent\Model;

class appraisals_datas extends Model
{
    protected $fillable = [
        'startDate',
        'endDate',
        'ongoing',
        'purpose',

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

        'agree',
        'performance',
        'foresight_option',
        'judgement_option',
        'paper_option',
        'oral_option',
        'numerical',
        'relations',
        'public_option',
        'acceptance',
        'reliability',
        'drive',
        'application',
        'management',
        'output',
        'work',
        'punctuality',
        'outstanding',
        'verygood',
        'generally',
        'moderate',
        'ineffective',
        'comment',
        'confirm',
        'level',
        'title',
        'dated',

        'needed',
        'recommended',
        'job',
        'joblevel',
        'reasons',
        'fitting',
        'position',
        'comment_recommendation',
        'considered',
        'reason',
        'future',
        'near',
        'potential',
        'exceptional',
        'additional',
        'served',
        'agreed',
        'grade',
        'day',
        'blockname',

        'reportconfirmation',
        'agreement',
        'grading',
        'serve',
        'blockfullname',

        'emailaddress',
        'dispute',
        'isDisputable',

        'isAwardable',
        'isCompleted',
        'isConsiderable'
    ];
}
