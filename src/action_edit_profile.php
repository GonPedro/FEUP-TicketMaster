<?php

declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');
require_once(__DIR__ . '/database/user.class.php');

$db = getDatabaseConnection();

$user = User::getUserFromID($db, $session->getID());

if($user){
    $user->username = $_POST['username'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->email = $_POST['email'];

    $user->save($db);

    $session->setName($user->username);
} 

header('Location: /profile.php');


?>