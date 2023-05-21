<?php 

declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
$session = new Session();
require_once(__DIR__ . '/common.tpl.php');


setHeader("Register");
if(!$session->isLoggedin()) drawRegister();
else header('Location : index.php')
?>

