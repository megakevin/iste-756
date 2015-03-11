<?php

abstract class BaseService
{
    private $connection;

    protected function get_connection()
    {
        if (!isset($this->connection))
        {
            $hostname = "localhost";
            $username = "kac2375";
            $password = ".que.vaina.es.esta.";
            $database = "kac2375";

            $this->connection = new mysqli($hostname, $username, $password, $database);

            if ($this->connection->connect_error)
            {
                throw new Exception($this->connection->connect_error);
            }
        }

        return $this->connection;
    }
}