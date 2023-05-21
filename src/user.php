<?php

declare(strict_types = 1);

require_once(__DIR__ . "/session.php");

$session = new Session();

require_once(__DIR__ . "/database/connection.db.php");

$db = getDatabaseConnection();

require_once(__DIR__ . "/database/user.class.php");

$user = User::getUserFromID($db, (int)$_GET['id']);

require_once(__DIR__ . "/user.tpl.php");
require_once(__DIR__ . "/common.tpl.php");
require_once(__DIR__ . "/database/department.class.php");

$user_departments = Department::getAgentDepartments($db, (int)$_GET['id']);
$departments = Department::getDepartments($db);

$role = User::getRole($db, $user->id);

setHeader("User Config");
if($session->isLoggedin()){
    drawTopbar($session);
    drawUserConfig($user, $user_departments, $departments, $role);
} else {
    header("Location : /index.php");
}