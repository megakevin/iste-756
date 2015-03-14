<?php

require_once "BaseModel.class.php";

class ShoppingCartItem extends BaseModel
{
    public $id;
    public $product_id;
    public $shopping_cart_id;
    public $product_quantity;

    public $product;

    public function __construct()
    {

    }

    public static function select_by($query, $id_to_look_by)
    {
        $result = array();

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("i", $id_to_look_by);

            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $shopping_cart_id, $product_id, $product_quantity);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $item = new ShoppingCartItem();

                    $item->id = $id;
                    $item->shopping_cart_id = $shopping_cart_id;
                    $item->product_id = $product_id;
                    $item->product_quantity = $product_quantity;

                    $result[] = $item;
                }
            }

            return $result;
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }

    public static function get_by($shopping_cart_id)
    {
        return ShoppingCartItem::select_by("SELECT id, shopping_cart_id, product_id, product_quantity
                                            FROM shopping_cart_items
                                            WHERE shopping_cart_id = ?", $shopping_cart_id);
    }

    public static function get_by_product_id($product_id)
    {
        return ShoppingCartItem::select_by("SELECT id, shopping_cart_id, product_id, product_quantity
                                            FROM shopping_cart_items
                                            WHERE product_id = ?", $product_id);
    }

    public function delete()
    {
        parent::delete("shopping_cart_items");
    }
}