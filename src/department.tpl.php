<?php

declare(strict_types = 1);

require_once(__DIR__ . "/session.php");

$session = new Session();

require_once(__DIR__ . "/database/connection.db.php");

$db = getDatabaseConnection();

require_once(__DIR__ . "/database/department.class.php");
require_once(__DIR__ . "/database/user.class.php");

?>

<?php function drawDepartments() { ?>
    <div class = "list">
        <?php
        $role = User::getRole($db, $session->getID());
        if($role == "admin"){
            $departments = Department::getDepartments($db);
            foreach($departments as $department) { ?>
                <div class = "ticket">
                    <a href="department.php?id=<?=$department->id?>"><label id="title"><?=$department->name?></label></a>
                </div>
            <?php } 
        } else if ($role == "agent") {
            $departments = Department::getAgentDepartments($db, $session->getID());
            foreach($departments as $department) { ?>
                <div class="ticket">
                    <a href="department.php?id=<?=$department->id?>"><label id="title"><?=$department->name?></label></a>
                </div>
            <?php }
        } else {
            header("Location : /index.php");
        } ?>
    </div>
<?php } ?>
