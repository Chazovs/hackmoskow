<?php


namespace App\Services;

/**
 * Class View
 * @package App\Services
 */
class Student
{
    /**
     * @param string $string
     * @param array  $vars
     * @return mixed
     */
    public static function file($path) {
        $file = file_get_contents($path);
        $file = json_decode($file);
        $itog = [];
        foreach ($file as $key=>$item) {
            array_push($itog,$item);
        }
        return $itog;
    }
}
