<?php
class Time
{
    public static function getDate_($time_zone,$format) {
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($time_zone)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        return $dt->format($format);
    }
}