<?php


declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__. '/database/user.class.php');

$password_regex = "^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$";

$white_space_regex = '/\s/';

$flag = 1;


if(User::findName($db, $_POST['rname'])){
    $flag = 0;
    $session->addMessage('failure', 'Username already exists');
}

if(preg_match($white_space_regex,$_POST['rname']) == 1){
    $flag = 0;
    $session->addMessage('failure', 'No White spaces');
}

if(preg_match($white_space_regex,$_POST['rmail']) == 1){
    $flag = 0;
    $session->addMessage('failure', 'No White spaces');
}

if(preg_match($white_space_regex,$_POST['rpass']) == 1){
    $flag = 0;
    $session->addMessage('failure', 'No White spaces');
}

if($_POST['rpass'] != $_POST['rpassrepeat']){
    $flag = 0;
    $session->addMessage('failure', 'Passwords do not match');
}

if((preg_match($password_regex, $_POST['rpass']) == 0) and $flag == 1){
    $user = User::addUser($db, $_POST['rmail'], $_POST['rname'], $_POST['rpass']);

    $session->setID($user->id);
    $session->setName($user->username);
    $session->addMessage('sucess', 'register successfull');

    header('Location: /index.php');
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>