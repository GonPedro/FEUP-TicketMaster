<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/session.php');
    $session = new Session();
    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/faq.class.php');
    $db = getDatabaseConnection();
    if($session->isLoggedin()){
        Faq::addFaq($db, $session->getID(), $_POST['title'], $_POST['content']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else {
        header('Location : /index.php');
    }
?>
