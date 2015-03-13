<?php

require "services/ProductService.class.php";
require "BaseController.class.php";
require "helpers/ValidationHelper.class.php";

class ProductController extends BaseController
{
    private $service;

    public function __construct($context)
    {
        $this->context = $context;
        $this->service = new ProductService();
    }

    public function get()
    {
        $this->paginate();
        $this->load_data();
    }

    public function paginate()
    {
        if ($this->page_is_valid())
        {
            $_SESSION["page"] = $_GET["page"];
        }
        else
        {
            $_SESSION["page"] = 1;
        }

        $this->context->prev_page = $_SESSION["page"] <= 1 ? 1 : $_SESSION["page"] - 1;
        $this->context->next_page = $_SESSION["page"] + 1;
    }

    public function post()
    {
        if (isset($_POST["add_to_cart_submit"]))
        {
            if ($this->add_to_cart_is_valid())
            {
                $this->service->add_product_to_cart($_POST["product_id"], $_SESSION["user"]["id"], session_id());
            }
        }

        $this->load_data();
    }

    public function load_data()
    {
        $this->context->products_on_sale = $this->service->get_products_on_sale();
        $this->context->products = $this->service->get_products_not_on_sale_page($_SESSION["page"]);

        if ($_SESSION["page"] == 1)
        {
            $this->context->is_first_page = true;
        }
        elseif (count($this->context->products) < $this->service->get_page_size())
        {
            $this->context->is_last_page = true;
        }

        //$this->context->products = $this->service->get_products();
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

    public function page_is_valid()
    {
        $validator = new ValidationHelper();

        return $validator->validate_number($_GET["page"]);
    }
}