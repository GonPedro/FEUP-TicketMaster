<?php
declare(strict_types = 1);

require_once(__DIR__ . '/database/department.class.php');
require_once(__DIR__ . '/database/connection.db.php');
require_once(__DIR__ . '/ticket.tpl.php');
require_once(__DIR__ . '/common.tpl.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/session.php');

$session = new Session();

setHeader('Department');
if($session->isLoggedIn()){
    if($department = Department::getDepartmentName($db, (int)$_GET['id'])){
        drawTopbar($session);
        drawDepartmentTickets($department);
    } else{
        header('Location : /departments.php');
    }
} else header('Location : /index.php');
