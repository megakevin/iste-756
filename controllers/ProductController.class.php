<?php

require "services/ProductService.class.php";
require "BaseController.class.php";

class ProductController extends BaseController
{
    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function get()
    {
        global $context;
        $service = new ProductService();

        $context->products_on_sale = $service->get_products_on_sale();
        $context->products = $service->get_products();
    }

    public function post()
    {
        echo "POST";
    }
}