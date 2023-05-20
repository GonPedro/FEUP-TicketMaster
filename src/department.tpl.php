<?php

declare(strict_types = 1);

require_once(__DIR__ . "/session.php");

require_once(__DIR__ . "/database/connection.db.php");

require_once(__DIR__ . "/database/department.class.php");

?>

<?php function drawDepartments(array $departments) { ?>
    <div class = "list">
        <?php
        foreach($departments as $department) { ?>
            <div class = "ticket">
                <a href="department.php?id=<?=$department->id?>"><label id="title"><?=$department->name?></label></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>
