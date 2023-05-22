<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/session.php');

    $session = new Session();

    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/hashtag.class.php');

    $db = getDatabaseConnection();

    Hashtag::deleteHashtag($db, (int)$_GET['id']);

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>