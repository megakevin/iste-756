<?php

require_once "BaseModel.class.php";
require "ShoppingCartItem.class.php";
require_once "Product.class.php";

class ShoppingCart extends BaseModel
{
    public $id;
    public $user_id;
    public $session_id;
    public $total_price;

    public $items;

    public function __construct()
    {

    }

    public static function get_by($user_id, $session_id)
    {
        $query = "SELECT id, user_id, session_id, total_price
                  FROM shopping_carts
                  WHERE user_id = ? AND session_id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("is", $user_id, $session_id);

            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $user_id, $session_id, $total_price);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $cart_to_return = new ShoppingCart();

                    $cart_to_return->id = $id;
                    $cart_to_return->user_id = $user_id;
                    $cart_to_return->session_id = $session_id;
                    $cart_to_return->total_price = $total_price;

                    return $cart_to_return;
                }
            }
            else
            {
                return null;
            }
        }
        else
        {
            throw new Exception("No connection with teh DB");
        }
    }

    public static function get_by_id($shopping_cart_id)
    {
        $query = "SELECT id, user_id, session_id, total_price
                  FROM shopping_carts
                  WHERE id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("i", $shopping_cart_id);

            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $user_id, $session_id, $total_price);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $cart_to_return = new ShoppingCart();

                    $cart_to_return->id = $id;
                    $cart_to_return->user_id = $user_id;
                    $cart_to_return->session_id = $session_id;
                    $cart_to_return->total_price = $total_price;

                    return $cart_to_return;
                }
            }
            else
            {
                return null;
            }
        }
        else
        {
            throw new Exception("No connection with teh DB");
        }
    }

    public function save()
    {
        $query = "INSERT INTO shopping_carts(user_id, session_id)
                  VALUES (?, ?)";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("is", $this->user_id, $this->session_id);

            $stmt->execute();

            $this->id = $stmt->insert_id;
        }

        if ($stmt->error)
        {
            throw new Exception($stmt->error);
        }
    }

    public function update()
    {
        $query = "UPDATE shopping_carts
                  SET user_id = ?, session_id = ?, total_price = ?
                  WHERE id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("isdi",
                $this->user_id,
                $this->session_id,
                $this->total_price,
                $this->id);

            $stmt->execute();
        }

        if ($stmt->error)
        {
            throw new Exception($stmt->error);
        }
    }

    public function get_items()
    {
        $this->items = array();
        $query = "SELECT sci.id, sci.product_id, sci.shopping_cart_id, sci.product_quantity,
                         p.name, p.description, p.is_on_sale, p.price, p.sale_price, p.quantity_in_stock, p.picture
                  FROM shopping_cart_items AS sci
                  INNER JOIN products AS p ON sci.product_id = p.id
                  WHERE sci.shopping_cart_id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("i", $this->id);

            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($shopping_cart_item_id, $product_id, $shopping_cart_id, $product_quantity,
                               $product_name, $product_description, $product_is_on_sale,
                               $product_price, $product_sale_price, $product_quantity_in_stock, $picture);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $item = new ShoppingCartItem();
                    $item->id = $shopping_cart_item_id;
                    $item->product_id = $product_id;
                    $item->shopping_cart_id = $shopping_cart_id;
                    $item->product_quantity = $product_quantity;

                    $product = new Product();
                    $product->id = $product_id;
                    $product->name = $product_name;
                    $product->description = $product_description;
                    $product->is_on_sale = $product_is_on_sale;
                    $product->price = $product_price;
                    $product->sale_price = $product_sale_price;
                    $product->quantity_in_stock = $product_quantity_in_stock;
                    $product->picture = $picture;

                    $item->product = $product;

                    $this->items[] = $item;
                }
            }

            return $this->items;
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }

    public function has_item($product_id)
    {
        $query = "SELECT id
                  FROM shopping_cart_items
                  WHERE shopping_cart_id = ? AND product_id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("ii", $this->id, $product_id);

            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }

    public function increment_item($product_id)
    {
        $query = "UPDATE shopping_cart_items
                  SET product_quantity = product_quantity + 1
                  WHERE shopping_cart_id = ? and product_id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("ii", $this->id, $product_id);

            $stmt->execute();
        }

        if ($stmt->error)
        {
            throw new Exception($stmt->error);
        }
    }

    public function add_item($product_id)
    {
        $query = "INSERT INTO shopping_cart_items(product_id, shopping_cart_id, product_quantity)
                  VALUES (?, ?, 1)";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("ii", $product_id, $this->id);

            $stmt->execute();
        }

        if ($stmt->error)
        {
            throw new Exception($stmt->error);
        }
    }

    public function calculate_total()
    {
        $items = ShoppingCartItem::get_by($this->id);

        $new_total = 0;

        foreach ($items as $item)
        {
            $product = Product::get_by_id($item->product_id);
            if ($product->is_on_sale)
            {
                $new_total += $product->sale_price * $item->product_quantity;
            }
            else
            {
                $new_total += $product->price * $item->product_quantity;
            }
        }

        $this->total_price = $new_total;
    }
}