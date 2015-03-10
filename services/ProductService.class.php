<?php

require "BaseService.class.php";

class ProductService extends BaseService
{
    public function __construct()
    {

    }

    public function get_products_on_sale()
    {
        return "get_products_on_sale";
    }

    public function get_products()
    {
        return "get_products";
    }
}