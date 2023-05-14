<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/session.php');

    $session = new Session();

    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/message.class.php');

    $db = getDatabaseConnection();

    Message::addMessage($db, $_GET['id'], $session->getID());

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>