<?php

require "BaseService.class.php";
require __DIR__ . "/../models/ShoppingCart.class.php";

class ShoppingCartService extends BaseService
{
    public function __construct()
    {

    }

    public function get_items($user_id, $session_id)
    {
        $shopping_cart = ShoppingCart::get_by($user_id, $session_id);
        return $shopping_cart->get_items();
    }
}