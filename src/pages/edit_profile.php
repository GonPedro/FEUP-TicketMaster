<?php

declare(strict_types = 1);

require_once(__DIR__ . "/../session.php");

$session = new Session();

require_once(__DIR__ . "/../database/connection.db.php");

$db = getDatabaseConnection();

require_once(__DIR__ . "/../database/user.class.php");

$user = User::getUserFromID($db, (int)$_GET['id']);

require_once(__DIR__ . "/../templates/user.tpl.php");
require_once(__DIR__ . "/../common.tpl.php");

setHeader("Edit Profile");
if($session->isLoggedin()){
    drawTopbar($session);
    drawEditProfile($db, $user);
} else {
    header("Location : /index.php");
}