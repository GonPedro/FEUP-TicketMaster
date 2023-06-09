<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');

    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/department.class.php');

    $db = getDatabaseConnection();

    Department::addDepartment($db, $session->getID(), $_POST['department']);

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>