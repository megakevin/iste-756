<?php
include "controllers/AdminController.class.php";

$context = new stdClass();
$controller = new AdminController($context);
$controller->process_request();

$page_title = "ISTE 756 - e-Store";
$page_content = "views/admin.view.php";
include "views/shared/layout.view.php";

//phpinfo();
?>