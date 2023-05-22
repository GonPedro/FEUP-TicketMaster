<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');

    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $db = getDatabaseConnection();

    User::depromote($db, $_GET['id']);

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>