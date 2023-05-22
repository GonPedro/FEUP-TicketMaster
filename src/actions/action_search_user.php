<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../session.php');
    $session = new Session();
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../templates/user.tpl.php');
    $db = getDatabaseConnection();

    if($user = User::getUserFromName($db, $_POST['user'])){
        drawUserInfo($session, $user);
    }

    if(strcmp("", $_POST['user']) == 0){
        $users = User::getUsers($db);
        foreach($users as $user){
            drawUserInfo($session, $user);
        }
    }

?>