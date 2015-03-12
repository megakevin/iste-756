<?php

require_once "models/Product.class.php";
require "models/ShoppingCart.class.php";


class ProductService
{
    public function __construct()
    {

    }

//    public function select($query, $bind_result_callback, $selector_callback)
//    {
//        $result = array();
//
//        $db = $this->get_connection();
//
//        if ($stmt = $db->prepare($query))
//        {
//            $stmt->execute();
//            $stmt->store_result();
//            $bind_result_callback($stmt);
//
//            if ($stmt->num_rows > 0)
//            {
//                while ($stmt->fetch())
//                {
//                    $result[] = $selector_callback();
//                }
//            }
//        }
//
//        return $result;
//    }
//
//    public function get_products_on_sale()
//    {
//
//        $query = "SELECT id, name, description, quantity_in_stock, picture, price, sale_price
//                  FROM products
//                  WHERE is_on_sale = TRUE";
//
//        $result = $this->select($query,
//                                function ($stmt)
//                                {
//                                    $stmt->bind_result($id, $name, $description, $quantity_in_stock, $picture, $price, $sale_price);
//                                },
//                                function ()
//                                {
//                                    $product = new Product();
//
//                                    $product->id = $id;
//                                    $product->name = $name;
//                                    $product->description = $description;
//                                    $product->quantity_in_stock = $quantity_in_stock;
//                                    $product->picture = $picture;
//                                    $product->price = $price;
//                                    $product->sale_price = $sale_price;
//
//                                    return $product;
//                                });
//
//        return $result;
//    }

    public function get_all_products()
    {
        return Product::get_all();
    }

    public function get_products_on_sale()
    {
        return Product::get_all_on_sale();
        //return Product::get();
    }

    public function get_products()
    {
        return Product::get_all_not_on_sale();
    }

    public function add_product_to_cart($product_id)
    {
        $product_to_update = Product::get_by_id($product_id);

        $product_to_update->reduce_quantity_in_stock_by(1);
        $product_to_update->update(); // TODO: Exception here if product not found

        $shopping_cart = ShoppingCart::get_by(100, "session"); //TODO: User Id and session

        if (!$shopping_cart)
        {
            $shopping_cart = new ShoppingCart();
            $shopping_cart->user_id = 100; //TODO: User Id and session
            $shopping_cart->session_id = "session"; //TODO: User Id and session
            $shopping_cart->save();
        }

        if ($shopping_cart->has_item($product_id))
        {
            $shopping_cart->increment_item($product_id);
        }
        else
        {
            $shopping_cart->add_item($product_id);
        }

        $shopping_cart->calculate_total();
        $shopping_cart->update();
    }

    public function update_product($data)
    {
        $product_to_update = Product::get_by_id($data["product_id"]);

        $product_to_update->name = $data["name"];
        $product_to_update->description = $data["description"];
        $product_to_update->price = $data["price"];
        $product_to_update->quantity_in_stock = $data["quantity_in_stock"];
        $product_to_update->sale_price = $data["sale_price"];
        $product_to_update->is_on_sale = $data["is_on_sale"];

        if ($data["picture"]["name"])
        {
            $target_file = "img/products/" . basename($data["picture"]["tmp_name"] . "." .
                    pathinfo($data["picture"]["name"],PATHINFO_EXTENSION));

            move_uploaded_file($data["picture"]["tmp_name"], $target_file);

            $product_to_update->picture = $target_file;
        }

        $product_to_update->update();
    }
}