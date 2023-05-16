<?php
declare(strict_types = 1);


require_once(__DIR__ . "/database/user.class.php");
require_once(__DIR__ . "/database/connection.db.php");
?>


<?php function drawProfile(PDO $db, User $user) { ?>
    <div class="profile">
        <img src="../images/gatito.png" id="pfp">
        <label id="username"><span id="bold">USERNAME:</span> <?=$user->username?></label>
        <label id="fullname"><span id="bold">FULL NAME:</span> <?=$user->fullname?></label>
        <label id="email"><span id="bold">E-MAIL:</span> <?=$user->email?></label>
        <label id="role"><span id="bold">ROLE:</span> <?=User::getRole($db,$user->id)?></label>
        <?php
        $role = User::getRole($db, $user->id);
        if(strcmp($role, "client") != 0){ ?>
            <label id="closedticks"><span id="bold">TICKETS:</span> <?=User::getClosedTickets($db, $user->id)?></label>
        <?php } ?>
        <button id="edit">EDIT</button>
    </div>
</body>

<?php } ?>