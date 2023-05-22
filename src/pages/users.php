<?php

declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');
$session = new Session();
require_once(__DIR__ . '/../database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/user.tpl.php');

require_once(__DIR__ . '/../database/user.class.php');

setHeader("Users");

$role = User::getRole($db, $session->getID());

if($session->isLoggedIn() and strcmp($role, "admin") == 0){
    $users = User::getUsers($db);
    drawTopbar($session);
    drawUsers($session, $users);
} else{
    header("Location: /index.php");
}




?>