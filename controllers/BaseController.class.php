<?php

abstract class BaseController
{
    protected $context;

    public function process_request()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $this->get();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $this->post();
        }
    }

    abstract public function get();
    abstract public function post();
}