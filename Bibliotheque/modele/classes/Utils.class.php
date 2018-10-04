<?php
class Utils
{
    public static function getField($champ,$method) {
        return (ISSET($method[$champ]))?$method[$champ]:'';
    }
    public static function getFieldConditionnally($champ,$method,$condition,$value)
    {
            return (($condition != $value)?'\''.$method[$champ].'\'':'\'\'');//we dont verify if $method[$champ] is set because we assume that when 
            //condition is true, then $method[$champ] is set
    }
}