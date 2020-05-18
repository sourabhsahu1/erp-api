<?php


namespace App\Services;


class UtilityService
{

    public static function recurseAndIncrementParentCount($data, $relation, &$count = 0)
    {
        if ($data->{$relation}) {
            ++$count;
            UtilityService::recurseAndIncrementParentCount($data->{$relation},$relation, $count);
        }
    }

}
