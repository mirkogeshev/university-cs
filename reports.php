<?php
	session_unset();
	require_once  'controller/reportController.php';		
    $controller = new reportController();	
    $controller->mvcHandler();
?>