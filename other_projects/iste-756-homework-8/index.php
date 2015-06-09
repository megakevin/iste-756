<?php
    include "controllers/Controller.class.php";

    $context = new stdClass();
    $controller = new Controller($context);
    $controller->process_request();

    $page_title = "ISTE 756 - Homework 8";
    $page_content = "views/index.view.php";
    include "views/shared/layout.view.php";

    //phpinfo();
?>