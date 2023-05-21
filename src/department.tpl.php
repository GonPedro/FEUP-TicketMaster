<?php

declare(strict_types = 1);

require_once(__DIR__ . "/session.php");

require_once(__DIR__ . "/database/connection.db.php");

require_once(__DIR__ . "/database/department.class.php");
require_once(__DIR__ . "/database/user.class.php");

?>

<?php function drawDepartments(Session $session, array $departments) { ?>
    <?php
    $db = getDatabaseConnection();
    $role = User::getRole($db, $session->getID());
    if($role == "admin"){ ?>
        <form action = "action_create_department.php" method = "post">
            <div class="userinput">
                <input type="text" name ="department">
                <input type="submit" value="Add">
            </div>
        </form>
   <?php } ?>
   

    <div class = "userlist">
        <?php
        foreach($departments as $department) { ?>
            <div class = "ticket">
                <a href="department.php?id=<?=$department->id?>"><label id="name"><?=$department->name?></label></a>
                <form action = "action_delete_department.php?id=<?=$department->id?>" method = "post">
                    <button id="remove">X</button>
                </form>
            </div>
        <?php } ?>
    </div>
<?php } ?>
