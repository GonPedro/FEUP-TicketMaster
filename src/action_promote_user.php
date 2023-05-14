<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/session.php');

    $session = new Session();

    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/user.class.php');

    $db = getDatabaseConnection();

    User::promote($db, $_GET['id'], $_POST['role']);

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>