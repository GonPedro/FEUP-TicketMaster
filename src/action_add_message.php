<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/session.php');
    $session = new Session();
    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/message.class.php');
    require_once(__DIR__ . '/ticket.tpl.php');
    $db = getDatabaseConnection();
    if(strcmp("", $_POST['message']) != 0) Message::addMessage($db, (int)$_GET['id'], $session->getID(), $_POST['message']);
    $messages = Message::getMessages($db, (int)$_GET['id']);
    drawRefreshedMessages($session, $messages);
