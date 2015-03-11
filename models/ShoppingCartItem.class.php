<?php

require_once "BaseModel.class.php";

class ShoppingCartItem extends BaseModel
{
    public $id;
    public $product_id;
    public $shopping_cart_id;
    public $product_quantity;

    public function __construct()
    {

    }

    public static function get_by($shopping_cart_id)
    {
        $result = array();
        $query = "SELECT id, shopping_cart_id, product_id, product_quantity
                  FROM shopping_cart_items
                  WHERE shopping_cart_id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("i", $shopping_cart_id);

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

}