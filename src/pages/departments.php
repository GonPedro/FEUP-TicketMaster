<?php 
declare(strict_types = 1);

require_once(__DIR__ . '/../database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__ . "/../session.php");

$session = new Session();


require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/department.tpl.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/user.class.php');


setHeader("Departments");
if($session->isLoggedIn()){
    drawTopbar($session);
    if(strcmp(User::getRole($db, $session->getID()), "admin") == 0){
        $departments = Department::getDepartments($db);
        drawDepartments($session, $departments);
    } else if(strcmp(User::getRole($db, $session->getID()), "agent") == 0){
        $departments = Department::getAgentDepartments($db, $session->getID());
        drawDepartments($session, $departments);
    } else {
        header('Location : /index.php');
    }
} else {
    header('Location : /index.php');
}
?>