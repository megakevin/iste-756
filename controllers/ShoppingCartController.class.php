<?php

require "BaseController.class.php";
require "services/ShoppingCartService.class.php";

class ShoppingCartController extends BaseController
{
    private $service;

    public function __construct($context)
    {
        $this->context = $context;
        $this->service = new ShoppingCartService();
    }

    public function get()
    {
        $this->load_data();
    }

    public function post()
    {
        if (isset($_POST["clear_cart_submit"]))
        {
            $this->service->clear_cart(100, "session"); //TODO: User Id and session
        }

        $this->load_data();
    }

    public function load_data()
    {
        $this->context->cart = $this->service->get_cart(100, "session"); //TODO: User Id and session
    }
}