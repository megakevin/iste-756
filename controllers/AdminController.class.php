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
        if (isset($_POST["edit_product_submit"]))
        {
            if ($this->edit_product_is_valid())
            {
                $update_data = $_POST;
                $update_data["picture"] = $_FILES["picture"];

                $this->service->update_product($update_data);
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
        $validator = new ValidationHelper();

        if (!$validator->validate_required($_POST["product_id"]))
        {
            $this->context->errors["product_id"][] = "Product Id is required.";
        }
        if (!$validator->validate_required($_POST["name"]))
        {
            $this->context->errors["name"][] = "Please enter the product's Name.";
        }
        if (!$validator->validate_required($_POST["description"]))
        {
            $this->context->errors["description"][] = "Please enter the product's Description.";
        }
        if (!$validator->validate_required($_POST["price"]))
        {
            $this->context->errors["price"][] = "Please enter the product's Price.";
        }
        if (!$validator->validate_required($_POST["quantity_in_stock"]))
        {
            $this->context->errors["quantity_in_stock"][] = "Please enter the product's Stock quantity.";
        }
        if (!$validator->validate_required($_POST["is_on_sale"]))
        {
            $this->context->errors["is_on_sale"][] = "Please specify whether the product's On Discount.";
        }

        if (!$validator->validate_number($_POST["product_id"]))
        {
            $this->context->errors["product_id"][] = "Not a valid Product Id.";
        }
        if (!$validator->validate_number($_POST["price"]))
        {
            $this->context->errors["price"][] = "Not a valid Price.";
        }
        if (!$validator->validate_number($_POST["quantity_in_stock"]))
        {
            $this->context->errors["quantity_in_stock"][] = "Not a valid Stock quantity.";
        }

        if ($validator->validate_checked($_POST["is_on_sale"]))
        {
            if (!$validator->validate_required($_POST["sale_price"]))
            {
                $this->context->errors["sale_price"][] =
                    "A Discount price is required if the product is On Discount.";
            }
        }

        if ($validator->validate_file_is_present($_FILES["picture"]))
        {
            if (!$validator->validate_file_is_picture($_FILES["picture"]))
            {
                $this->context->errors["picture"][] = "Only image files are allowed.";
            }
        }

        # If there are no errors, then the input is valid
        return empty($this->context->errors);
    }
}