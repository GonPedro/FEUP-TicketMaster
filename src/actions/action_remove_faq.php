<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/session.php');
    $session = new Session();
    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/faq.class.php');
    $db = getDatabaseConnection();
    if($session->isLoggedin()){
        Faq::removeFaq($db, (int)$_GET['id']);
        header('Location: /faq_config.php');
    }
    else {
        header('Location : /index.php');
    }
?>
