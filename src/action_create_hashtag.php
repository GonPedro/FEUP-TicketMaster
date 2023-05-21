<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/session.php');

    $session = new Session();

    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/hashtag.class.php');

    $db = getDatabaseConnection();
    
    if(Hashtag::checkName($db, $_POST['hashtag'])){
        Hashtag::addHashtag($db, $session->getID(), $_POST['hashtag']);
    }


    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>