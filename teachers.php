<?php
	session_unset();
	require_once  'controller/teacherController.php';		
    $controller = new teacherController();	
    $controller->mvcHandler();
?>