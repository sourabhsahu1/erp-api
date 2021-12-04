<?php

namespace Modules\Appraisal\Entities;

use Illuminate\Database\Eloquent\Model;

class supervisorsAppraisal extends Model
{
    protected $fillable = [
        'fileno',
        'supervisors_fileno',
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
        'isConsiderable'
        
    ];
}
