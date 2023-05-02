<?php


declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__. '/database/user.class.php');

$user = User::addUser($db, $_POST['email'], $_POST['username'], $_POST['password']);

$session->setID($user->id);
$session->serName($user->name);

header('Location: ' . index.php);