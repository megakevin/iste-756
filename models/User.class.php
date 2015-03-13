<?php

require_once "BaseModel.class.php";

class User extends BaseModel
{
    public $id;
    public $email;
    public $password;
    public $nick_name;
    public $role;

    public function __construct()
    {

    }

    public function to_assoc_array()
    {
        return array(
            "id" => $this->id,
            "email" => $this->email,
            //"password" => $this->password,
            "nick_name" => $this->nick_name,
            "role" => $this->role,
        );
    }

    public static function get_by($username, $password)
    {
        // TODO: Store encrypted passwords
        $query = "SELECT u.id, u.email, u.password, u.nick_name, r.description
                  FROM users AS u
                  INNER JOIN roles AS r ON u.role_id = r.id
                  WHERE email = ? AND password = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("ss", $username, $password);

            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $email, $password, $nick_name, $role);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $user_to_return = new User();

                    $user_to_return->id = $id;
                    $user_to_return->email = $email;
                    $user_to_return->password = $password;
                    $user_to_return->nick_name = $nick_name;
                    $user_to_return->role = $role;

                    return $user_to_return;
                }
            }
            else
            {
                return null;
            }
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }
}