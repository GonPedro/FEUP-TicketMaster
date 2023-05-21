<?php

declare(strict_types = 1);

require_once(__DIR__ . "/session.php");

require_once(__DIR__ . "/database/connection.db.php");

require_once(__DIR__ . "/database/department.class.php");

?>

<?php function drawDepartments(array $departments) { ?>
    <form action = "action_create_department.php" method = "post">
        <div class="userinput">
            <input type="text" name ="department">
            <input type="submit" value="Add">
        </div>
    </form>

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
