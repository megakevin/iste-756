<?php

abstract class BaseService
{
    private static function get_connection()
    {
        $hostname = "localhost";
        $username = "kac2375";
        $password = ".que.vaina.es.esta.";
        $database = "kac2375";

        $db = new mysqli($hostname, $username, $password, $database);

        if ($db->connect_error)
        {
            throw new Exception($db->connect_error);
        }

        return $db;
    }
}