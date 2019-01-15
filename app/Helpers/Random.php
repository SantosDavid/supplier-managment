<?php

if (!function_exists('random_unique')) {
    function random_unique($minimun = 80, $maximum = 180)
    {
        return str_random(rand($minimun, $maximum)) . uniqid();
    }
}
