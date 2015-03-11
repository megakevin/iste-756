<?php

require "services/ProductService.class.php";
require "BaseController.class.php";
require __DIR__ . "/../helpers/ValidationHelper.class.php";

class ProductController extends BaseController
{
    private $context;
    private $service;

    public function __construct($context)
    {
        $this->context = $context;
        $this->service = new ProductService();
    }

    public function get()
    {
        $this->load_data();
    }

    public function post()
    {
        if (isset($_POST["add_to_cart_submit"]))
        {
            if ($this->add_to_cart_is_valid())
            {
                echo "<pre>";
                print_r($_POST);
                echo "</pre>";

                $this->service->add_product_to_cart($_POST["product_id"]);
            }
        }

        $this->load_data();
    }

    public function load_data()
    {
        $this->context->products_on_sale = $this->service->get_products_on_sale();
        $this->context->products = $this->service->get_products();
    }

    public function add_to_cart_is_valid()
    {
        $validator = new ValidationHelper();

        if (!$validator->validate_number($_POST["product_id"]))
        {
            $this->context->errors["product_id"][] = "Not a valid Product Id.";
        }

        # If there are no errors, then the input is valid
        return empty($this->context->errors);
    }
}