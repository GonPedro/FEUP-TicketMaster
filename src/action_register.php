<?php


declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__. '/database/user.class.php');

$flag = 1;

$lenght_regex = "^{0,7}$";
$number_regex = "^(?=.*\d)$";
$upper_case_regex = "^(?=.*[A-Z])$";
$lower_case_regex = "^(?=.*[a-z])$";
$special_char_regex = "^(?=.*[.,#-_])$";

if($_POST['rpass'] != $_POST['rpassrepeat']){
    $session->addMessage('failure', 'Not enough characters');
    header('Location:' . $_SERVER['HTTP_REFERER']);
    $flag = 0;
}


if(preg_match($lenght_regex, $_POST['rpass']) == 1){
    $session->addMessage('failure', 'Not enough characters');
    header('Location:' . $_SERVER['HTTP_REFERER']);
    $flag = 0;
}

if(preg_match($number_regex, $_POST['rpass']) == 0){
    $session->addMessage('failure', 'At least one digit in the password');
    header('Location:' . $_SERVER['HTTP_REFERER']);
    $flag = 0;
}

if(preg_match($upper_case_regex, $_POST['rpass']) == 0){
    $session->addMessage('failure', 'At least one upper case character in the password');
    header('Location:' . $_SERVER['HTTP_REFERER']);
    $flag = 0;
}


if(preg_match($lower_case_regex, $_POST['rpass']) == 0){
    $session->addMessage('failure', 'At least one lower case character in the password');
    header('Location:' . $_SERVER['HTTP_REFERER']);
    $flag = 0;
}


if((preg_match($special_char_regex, $_POST['rpass']) == 0) && $flag == 1){
    $user = User::addUser($db, $_POST['rmail'], $_POST['rname'], $_POST['rpass']);

    $session->setID($user->id);
    $session->setName($user->username);
    $session->addMessage('sucess', 'register successful');

    header('Location: ' . index.php);
} else {
    header('Location:' . $_SERVER['HTTP_REFERER']);
}