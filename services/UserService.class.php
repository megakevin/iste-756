<?php

require "models/User.class.php";
require "models/ShoppingCart.class.php";


class UserService
{
    public function __construct()
    {

    }

    public function register($data)
    {
        try
        {
            $user_to_return = User::create_customer($data["username"], $data["password"]);

            $this->reassign_shopping_cart($user_to_return);

            return $user_to_return;
        }
        catch (Exception $ex)
        {
            throw new Exception("Username already exists.");
        }
    }

    public function authenticate($data)
    {
        $user_to_return = User::get_by($data["username"], $data["password"]);

        $this->reassign_shopping_cart($user_to_return);

        if ($user_to_return)
        {
            return $user_to_return;
        }
        else
        {
            throw new Exception("Wrong username and password.");
        }
    }

    public function reassign_shopping_cart($user)
    {
        $shopping_cart = ShoppingCart::get_by($user->id, session_id());

        if ($shopping_cart)
        {
            $shopping_cart->session_id = "";
            $shopping_cart->user_id = $user->id;
            $shopping_cart->update();
        }
    }
}