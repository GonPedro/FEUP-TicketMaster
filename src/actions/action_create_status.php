<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/session.php');

    $session = new Session();

    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/status.class.php');

    $db = getDatabaseConnection();
    
    if(Status::checkName($db, $_POST['status'])){
        Status::addStatus($db, $session->getID(), $_POST['status']);
    }


    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>