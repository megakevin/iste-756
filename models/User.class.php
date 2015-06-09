<?php

require_once "BaseModel.class.php";

class User extends BaseModel
{
    public $id;
    public $email;
    public $password;
    public $nick_name;

    public $role_id;
    public $role;

    public static $customer_role_id = 1;
    public static $customer_role_description = "customer";

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

    public static function create_customer($username, $password)
    {
        $user_to_create = new User();

        $user_to_create->email = $username;
        $user_to_create->password = $password;
        //$user_to_create->nick_name = ""; NOT USED
        $user_to_create->role_id = User::$customer_role_id;
        $user_to_create->role = User::$customer_role_description;

        $user_to_create->save();

        return $user_to_create;
    }

    public function save()
    {
        $query = "INSERT INTO users(email, password, nick_name, role_id)
                  VALUES (?, ?, '', ?)";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("ssi", $this->email, $this->password, $this->role_id);

            $stmt->execute();

            $this->id = $stmt->insert_id;
        }

        if ($stmt->error)
        {
            throw new Exception($stmt->error);
        }
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