<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');

$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/user.class.php');

$db = getDatabaseConnection();

$departments = Department::getAgentDepartments($db, (int)$_GET['id']);

$flag = 1;

if($_POST['department']){
    foreach($departments as $department){
        if(strcmp($department->name, $_POST['department']) == 0){
            $flag = 0;
        }
    }
    
    
    if($flag == 1){
            $department_id = Department::getDepartmentID($db, $_POST['department']);
            Department::addAgentToDepartment($db, $department_id, (int)$_GET['id']);
    }
}

User::promote($db, (int)$_GET['id'], $_POST['role']);

header('Location: ' . $_SERVER['HTTP_REFERER']);