<?php

class HttpHelper
{
    public static function redirect($url, $params)
    {
        header("Location: " . $url);
    }
}


?>