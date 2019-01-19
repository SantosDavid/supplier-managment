<?php

if (!function_exists('responseError')) {
    function responseError($error, $code = 500)
    {
        return response(['message' => $error], $code);
    }
}

if (!function_exists('responseSuccess')) {
    function responseSuccess($data, $code = 200, $message = '')
    {
        return response(['message' => $message, 'data' => $data], $code);
    }
}
