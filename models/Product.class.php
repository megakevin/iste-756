<?php

require_once "BaseModel.class.php";

class Product extends BaseModel
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $quantity_in_stock;
    public $picture;
    public $is_on_sale;
    public $sale_price;

    public function __construct()
    {

    }

    public static function get_by_id($id)
    {
        $query = "SELECT id, name, description, price, quantity_in_stock, picture, is_on_sale, sale_price
                  FROM products
                  WHERE id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("i", $id);

            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $description, $price, $quantity_in_stock, $picture, $is_on_sale, $sale_price);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $product_to_return = new Product();

                    $product_to_return->id = $id;
                    $product_to_return->name = $name;
                    $product_to_return->description = $description;
                    $product_to_return->price = $price;
                    $product_to_return->quantity_in_stock = $quantity_in_stock;
                    $product_to_return->picture = $picture;
                    $product_to_return->is_on_sale = $is_on_sale;
                    $product_to_return->sale_price = $sale_price;

                    return $product_to_return;
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
    
//    public static function select($query, $bind_result_callback, $selector_callback)
//    {
//        $result = array();
//
//        $db = BaseModel::get_connection();
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
//    public static function get()
//    {
//        $id = "";
//        $name = "";
//        $description = "";
//        $quantity_in_stock = "";
//        $picture = "";
//        $price = "";
//        $sale_price = "";
//        $is_on_sale = "";
//
//        return Product::select("SELECT id, name, description, quantity_in_stock, picture, price, sale_price, is_on_sale
//                                FROM products
//                                WHERE is_on_sale = TRUE",
//                                function ($stmt)
//                                {
//                                    $stmt->bind_result($id, $name, $description, $quantity_in_stock, $picture, $price, $sale_price, $is_on_sale);
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
//                                    $product->is_on_sale = $is_on_sale;
//
//                                    return $product;
//                                });
//    }

    public function get_all()
    {
        $result = array();
        $query = "SELECT id, name, description, quantity_in_stock, picture, price, sale_price, is_on_sale
                  FROM products";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $description, $quantity_in_stock, $picture, $price, $sale_price, $is_on_sale);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $product = new Product();

                    $product->id = $id;
                    $product->name = $name;
                    $product->description = $description;
                    $product->quantity_in_stock = $quantity_in_stock;
                    $product->picture = $picture;
                    $product->price = $price;
                    $product->sale_price = $sale_price;
                    $product->is_on_sale = $is_on_sale;

                    $result[] = $product;
                }
            }

            return $result;
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }

    public static function get_all_on_sale()
    {
        $result = array();
        $query = "SELECT id, name, description, quantity_in_stock, picture, price, sale_price, is_on_sale
                  FROM products
                  WHERE is_on_sale = TRUE";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $description, $quantity_in_stock, $picture, $price, $sale_price, $is_on_sale);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $product = new Product();

                    $product->id = $id;
                    $product->name = $name;
                    $product->description = $description;
                    $product->quantity_in_stock = $quantity_in_stock;
                    $product->picture = $picture;
                    $product->price = $price;
                    $product->sale_price = $sale_price;
                    $product->is_on_sale = $is_on_sale;

                    $result[] = $product;
                }
            }

            return $result;
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }

    public static function get_all_not_on_sale()
    {
        $result = array();
        $query = "SELECT id, name, description, quantity_in_stock, picture, price, sale_price, is_on_sale
                  FROM products
                  WHERE is_on_sale = FALSE";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $description, $quantity_in_stock, $picture, $price, $sale_price, $is_on_sale);

            if ($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $product = new Product();

                    $product->id = $id;
                    $product->name = $name;
                    $product->description = $description;
                    $product->quantity_in_stock = $quantity_in_stock;
                    $product->picture = $picture;
                    $product->price = $price;
                    $product->sale_price = $sale_price;
                    $product->is_on_sale = $is_on_sale;

                    $result[] = $product;
                }
            }

            return $result;
        }
        else
        {
            throw new Exception("No connection with the DB");
        }
    }

    public function update()
    {
        $query = "UPDATE products
                  SET name = ?,
                      description = ?,
                      price = ?,
                      quantity_in_stock = ?,
                      picture = ?,
                      is_on_sale = ?,
                      sale_price = ?
                  WHERE id = ?";

        $db = BaseModel::get_connection();

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param("ssdisidi",
                $this->name,
                $this->description,
                $this->price,
                $this->quantity_in_stock,
                $this->picture,
                $this->is_on_sale,
                $this->sale_price,
                $this->id);

            $stmt->execute();
        }

        if ($stmt->error)
        {
            throw new Exception($stmt->error);
        }
    }

    public function reduce_quantity_in_stock_by($quantity_to_reduce)
    {
        if ($this->quantity_in_stock >= $quantity_to_reduce)
        {
            $this->quantity_in_stock -= $quantity_to_reduce;
        }
        else
        {
            throw new Exception("Not enough in stock");
        }
    }

    public function increase_quantity_in_stock_by($quantity_to_increase)
    {
        if ($quantity_to_increase > 0)
        {
            $this->quantity_in_stock += $quantity_to_increase;
        }
        else
        {
            throw new Exception("Cannot increase by negative number");
        }
    }
}