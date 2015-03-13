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
                $update_data = array(
                    "product_id" => $_POST["product_id"],
                    "name" => $_POST["name" . $_POST["product_id"]],
                    "description" => $_POST["description" . $_POST["product_id"]],
                    "price" => $_POST["price" . $_POST["product_id"]],
                    "quantity_in_stock" => $_POST["quantity_in_stock" . $_POST["product_id"]],
                    "sale_price" => $_POST["sale_price" . $_POST["product_id"]],
                    "is_on_sale" => $_POST["is_on_sale" . $_POST["product_id"]],
                    "picture" => $_FILES["picture" . $_POST["product_id"]]
                );

                $this->service->update_product($update_data);
            }
        }
        elseif (isset($_POST["delete_product_submit"]))
        {
            if ($this->delete_product_is_valid())
            {
                try
                {
                    $this->service->delete_product($_POST["product_id"]);
                }
                catch (Exception $ex)
                {
                    $this->context->errors["rule_error" . $_POST["product_id"]][] = $ex->getMessage();
                }
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
        if (!$validator->validate_required($_POST["name" . $_POST["product_id"]]))
        {
            $this->context->errors["name" . $_POST["product_id"]][] = "Please enter the product's Name.";
        }
        if (!$validator->validate_required($_POST["description" . $_POST["product_id"]]))
        {
            $this->context->errors["description" . $_POST["product_id"]][] = "Please enter the product's Description.";
        }
        if (!$validator->validate_required($_POST["price" . $_POST["product_id"]]))
        {
            $this->context->errors["price" . $_POST["product_id"]][] = "Please enter the product's Price.";
        }
        if (!$validator->validate_required($_POST["quantity_in_stock" . $_POST["product_id"]]))
        {
            $this->context->errors["quantity_in_stock" . $_POST["product_id"]][] = "Please enter the product's Stock quantity.";
        }
        if (!$validator->validate_required($_POST["is_on_sale" . $_POST["product_id"]]))
        {
            $this->context->errors["is_on_sale" . $_POST["product_id"]][] = "Please specify whether the product's On Discount.";
        }

        if (!$validator->validate_number($_POST["product_id"]))
        {
            $this->context->errors["product_id" ][] = "Not a valid Product Id.";
        }
        if (!$validator->validate_number($_POST["price" . $_POST["product_id"]]))
        {
            $this->context->errors["price" . $_POST["product_id"]][] = "Not a valid Price.";
        }
        if (!$validator->validate_number($_POST["quantity_in_stock" . $_POST["product_id"]]))
        {
            $this->context->errors["quantity_in_stock" . $_POST["product_id"]][] = "Not a valid Stock quantity.";
        }

        if ($validator->validate_checked($_POST["is_on_sale" . $_POST["product_id"]]))
        {
            if (!$validator->validate_required($_POST["sale_price" . $_POST["product_id"]]))
            {
                $this->context->errors["sale_price" . $_POST["product_id"]][] =
                    "A Discount price is required if the product is On Discount.";
            }
        }

        if ($validator->validate_file_is_present($_FILES["picture" . $_POST["product_id"]]))
        {
            if (!$validator->validate_file_is_picture($_FILES["picture" . $_POST["product_id"]]))
            {
                $this->context->errors["picture" . $_POST["product_id"]][] = "Only image files are allowed.";
            }
        }

        # If there are no errors, then the input is valid
        return empty($this->context->errors);
    }

    public function delete_product_is_valid()
    {
        $validator = new ValidationHelper();

        if (!$validator->validate_required($_POST["product_id"]))
        {
            $this->context->errors["product_id"][] = "Product Id is required.";
        }

        if (!$validator->validate_number($_POST["product_id"]))
        {
            $this->context->errors["product_id" ][] = "Not a valid Product Id.";
        }

        # If there are no errors, then the input is valid
        return empty($this->context->errors);
    }
}