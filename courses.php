<?php
	session_unset();
	require_once  'controller/courseController.php';
    $controller = new courseController();
    $controller->mvcHandler();
?>