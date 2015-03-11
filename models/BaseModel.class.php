<?php

abstract class BaseModel
{
    private static $connection;

    protected static function get_connection()
    {
        if (!isset(BaseModel::$connection))
        {
            $hostname = "localhost";
            $username = "kac2375";
            $password = ".que.vaina.es.esta.";
            $database = "kac2375";

            BaseModel::$connection = new mysqli($hostname, $username, $password, $database);

            if (BaseModel::$connection->connect_error)
            {
                throw new Exception(BaseModel::$connection->connect_error);
            }
        }

        return BaseModel::$connection;
    }
}