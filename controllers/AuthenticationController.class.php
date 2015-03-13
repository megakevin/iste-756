<?php

require "services/UserService.class.php";
require "BaseController.class.php";
require "helpers/ValidationHelper.class.php";
require "helpers/HttpHelper.class.php";

class AuthenticationController extends BaseController
{
    private $service;

    public function __construct($context)
    {
        $this->context = $context;
        $this->service = new UserService();
    }

    public function get()
    {

    }

    public function post()
    {
        if (isset($_POST["login_submit"]))
        {
            if ($this->is_valid())
            {
                try
                {
                    $authenticated_user = $this->service->authenticate($_POST);
                    $_SESSION["user"] = $authenticated_user->to_assoc_array();

                    HttpHelper::redirect("index.php");
                }
                catch (Exception $ex)
                {
                    $this->context->errors["rule_error"][] = $ex->getMessage();
                }
            }
        }
    }

    public function is_valid()
    {
        $validator = new ValidationHelper();

        if (!$validator->validate_required($_POST["username"]))
        {
            $this->context->errors["username"][] = "Username required.";
        }
        if (!$validator->validate_required($_POST["password"]))
        {
            $this->context->errors["password"][] = "Password required.";
        }

        if (!$validator->validate_email($_POST["username"]))
        {
            $this->context->errors["username"][] = "Username must be a valid email.";
        }

        # If there are no errors, then the input is valid
        return empty($this->context->errors);
    }
}