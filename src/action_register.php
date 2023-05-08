<?php


declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__. '/database/user.class.php');

$password_regex = "^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$";

if(preg_match($password_regex, $_POST['rpass']) == 0){
    $user = User::addUser($db, $_POST['rmail'], $_POST['rname'], $_POST['rpass']);

    $session->setID($user->id);
    $session->setName($user->username);

    header('Location: ' . index.php);
} else {
    header('Location:' . $_SERVER['HTTP_REFERER']);
}