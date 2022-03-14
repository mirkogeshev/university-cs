<?php
    session_unset();
    require_once  'controller/subjectController.php';		
    $controller = new subjectController();
    $controller->mvcHandler();
?>