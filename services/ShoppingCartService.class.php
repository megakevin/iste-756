<?php

require "BaseService.class.php";
require __DIR__ . "/../models/ShoppingCart.class.php";

class ShoppingCartService extends BaseService
{
    public function __construct()
    {

    }

    public function get_cart($user_id, $session_id)
    {
        $shopping_cart = ShoppingCart::get_by($user_id, $session_id);
        $shopping_cart->get_items();
        return $shopping_cart;
    }

    public function clear_cart($user_id, $session_id)
    {
        $shopping_cart = ShoppingCart::get_by($user_id, $session_id);

        foreach ($shopping_cart->get_items() as $cart_item)
        {
            $cart_item->product->increase_quantity_in_stock_by($cart_item->product_quantity);
            $cart_item->product->update();
            $cart_item->delete();
        }

        $shopping_cart->calculate_total();
        $shopping_cart->update();
    }
}