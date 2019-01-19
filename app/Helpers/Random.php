<?php

if (!function_exists('random_unique')) {
    function random_unique($minimun = 80, $maximum = 180)
    {
        return str_random(rand($minimun, $maximum)) . uniqid();
    }
}

if (!function_exists('random_array_float')) {
    function random_array_float($length = 10)
    {
        $array = [];

        for ($i=0; $i<= $length; $i++) {
            $array[] = rand(1, 9999) / 100;
        }

        return $array;
    }
}
