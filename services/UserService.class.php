<?php

require "models/User.class.php";
require "models/ShoppingCart.class.php";


class UserService
{
    public function __construct()
    {

    }

    public function authenticate($data)
    {
        $user_to_return = User::get_by($data["username"], $data["password"]);

        $shopping_cart = ShoppingCart::get_by($user_to_return->id, session_id());

        if ($shopping_cart)
        {
            $shopping_cart->session_id = "";
            $shopping_cart->user_id = $user_to_return->id;
            $shopping_cart->update();
        }

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