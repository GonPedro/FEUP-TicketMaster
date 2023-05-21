<?php

declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
$session = new Session();
require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/common.tpl.php');
require_once(__DIR__ . '/user.tpl.php');

require_once(__DIR__ . '/database/user.class.php');

setHeader("Users");

if($session->isLoggedIn()){
    $role = User::getRole($db, $session->getID());
    if($role == "admin"){
        $users = User::getUsers($db);
        drawTopbar($session);
        drawUsers($session, $users);
    } else {
        header('Location : /index.php');
    }
} else header('Location : /index.php');




?>