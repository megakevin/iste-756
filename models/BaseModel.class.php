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

    public function delete($table)
    {
        $query = "DELETE FROM $table WHERE id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("i", $this->id);

            $stmt->execute();

            if ($stmt->error)
            {
                throw new Exception($stmt->error);
            }
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }
}