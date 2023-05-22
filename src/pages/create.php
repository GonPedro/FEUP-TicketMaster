<?php

declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');
$session = new Session();
require_once(__DIR__ . '/../templates/common.tpl.php');

setHeader("Create");

if($session->isLoggedIn()){
    drawTopbar($session);
    drawTicketForm();
} else header('Location : /index.php');




?>