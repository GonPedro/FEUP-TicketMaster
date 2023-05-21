<?php

declare(strict_types = 1);

require_once(__DIR__ . "/session.php");

require_once(__DIR__ . "/database/connection.db.php");

require_once(__DIR__ . "/database/department.class.php");
require_once(__DIR__ . "/database/user.class.php");

?>

<?php function drawStatuses(Session $session, array $statuses) { ?>
    <?php
    $db = getDatabaseConnection();
    $role = User::getRole($db, $session->getID());
    if($role == "admin"){ ?>
        <form action = "action_create_status.php" method = "post">
            <div class="userinput">
                <input type="text" name ="status">
                <input type="submit" value="Add">
            </div>
        </form>
   <?php } ?>
   

    <div class = "userlist">
        <?php
        foreach($statuses as $status) { ?>
            <div class = "ticket">
                <label id="name"><?=$status->name?></label>
                <form action = "action_delete_status.php?id=<?=$status->id?>" method = "post">
                    <button id="remove">X</button>
                </form>
            </div>
        <?php } ?>
    </div>
<?php } ?>