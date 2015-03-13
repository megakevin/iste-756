<?php
    include "controllers/AuthenticationController.class.php";

    $context = new stdClass();
    $controller = new AuthenticationController($context);
    $controller->process_request();

    $page_title = "ISTE 756 - e-Store";
    $page_content = "views/login.view.php";
    include "views/shared/layout.view.php";
?>