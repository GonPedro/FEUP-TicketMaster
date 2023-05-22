<?php

declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');
require_once(__DIR__ . '/database/user.class.php');

$db = getDatabaseConnection();

$flag = 1;

$password_regex = "^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$";

if((preg_match($password_regex, $_POST['password'])) != 0 and $_POST['password'] != ""){
    $flag = 0;
    $session->addMessage('failure', 'Invalid Password');
}

if(User::findName($db, $_POST['username']) and $_POST['username'] != $_POST['confirm']){
    $flag = 0;
    $session->addMessage('failure', 'Username already exists');
}

$user = User::getUserFromID($db, $session->getID());

if($user and $flag == 1){
    $user->username = $_POST['username'];
    $user->fullname = $_POST['fullname'];
    $user->email = $_POST['email'];

    $user->save($db, $_POST['password']);

    $session->setName($user->username);
    header('Location: /profile.php?id='.$user->id);
}else{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>