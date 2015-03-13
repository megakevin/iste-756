<?php

require "models/User.class.php";


class UserService
{
    public function __construct()
    {

    }

    public function authenticate($data)
    {
        $user_to_return = User::get_by($data["username"], $data["password"]);

        if ($user_to_return)
        {
            return $user_to_return;
        }
        else
        {
            throw new Exception("Wrong username and password.");
        }
    }
}