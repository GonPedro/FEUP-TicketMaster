<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/../session.php');

    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $db = getDatabaseConnection();

    $user = User::getUser($db, $_POST['username'], $_POST['password']);

    if($user){
        $session->setID($user->id);
        $session->setName($user->username);
        $session->addMessage('sucess', 'Login successful');
        header('Location: /index.php');
    } else {
        $session->addMessage('failure', 'Wrong password');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

?>