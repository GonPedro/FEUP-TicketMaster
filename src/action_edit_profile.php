<?php

declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');
require_once(__DIR__ . '/database/user.class.php');

$db = getDatabaseConnection();

$flag = 1;

if(preg_match($white_space_regex, $_POST['username']) == 1){
    $flag = 0;
    $session->addMessage('failure', 'No White spaces');
}

if(preg_match($white_space_regex, $_POST['firstname']) == 1){
    $flag = 0;
    $session->addMessage('failure', 'No White spaces');
}

if(preg_match($white_space_regex, $_POST['lastname']) == 1){
    $flag = 0;
    $session->addMessage('failure', 'No White spaces');
}

if(preg_match($white_space_regex, $_POST['email']) == 1){
    $flag = 0;
    $session->addMessage('failure', 'No White spaces');
}


if(User::findName($db, $_POST['username'])){
    $flag = 0;
    $session->addMessage('failure', 'Username already exists');
}

$user = User::getUserFromID($db, $session->getID());

if($user and $flag == 1){
    $user->username = $_POST['username'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->email = $_POST['email'];

    $user->save($db);

    $session->setName($user->username);
} 

header('Location: /profile.php');


?>