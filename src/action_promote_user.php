<?php

    declare(strict_types = 1);

    require_once(__DIR__ . '/session.php');

    $session = new Session();

    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/user.tpl.php');
    require_once(__DIR__ . '/database/user.class.php');

    $db = getDatabaseConnection();

    User::promote($db, (int)$_POST['user'], $_POST['role']);

    $users = User::getUsers($db);

    foreach($users as $user){
        drawUserInfo($session, $user);
    }


?>