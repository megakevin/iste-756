<?php

require "services/ProductService.class.php";
require "BaseController.class.php";
require "helpers/ValidationHelper.class.php";

class AdminController extends BaseController
{
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
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        if (isset($_POST["edit_product_submit"]))
        {
            if ($this->edit_product_is_valid())
            {
                $this->service->update_product($_POST);
            }
        }

        $this->load_data();
    }

    public function load_data()
    {
        $this->context->products = $this->service->get_all_products();
    }

    public function edit_product_is_valid()
    {
//        $validator = new ValidationHelper();
//
//        if (!$validator->validate_required($_POST["product_id"]))
//        {
//            $this->context->errors["product_id"][] = "Product Id is required.";
//        }
//        if (!$validator->validate_required($_POST["name"]))
//        {
//            $this->context->errors["name"][] = "Product Id is required.";
//        }
//
//        if (!$validator->validate_number($_POST["product_id"]))
//        {
//            $this->context->errors["product_id"][] = "Not a valid Product Id.";
//        }

        /*    public $id;
    public $name;
    public $description;
    public $price;
    public $quantity_in_stock;
    public $picture;
    public $is_on_sale;
    public $sale_price;*/

        # If there are no errors, then the input is valid
        return empty($this->context->errors);
    }
}