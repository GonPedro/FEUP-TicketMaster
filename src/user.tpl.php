<?php
declare(strict_types = 1);


require_once(__DIR__ . "/database/user.class.php");
require_once(__DIR__ . "/database/connection.db.php");
require_once(__DIR__ . "/session.php");
?>


<?php function drawProfile(PDO $db, Session $session, User $user) { ?>
    <div class="profile">
        <img src="/profileImages/kaguya-sama-pelicula-min.jpg" id="pfp">
        <label id="username"><span id="bold">USERNAME:</span> <?=$user->username?></label>
        <label id="fullname"><span id="bold">FULL NAME:</span> <?=$user->fullname?></label>
        <label id="email"><span id="bold">E-MAIL:</span> <?=$user->email?></label>
        <label id="role"><span id="bold">ROLE:</span> <?=User::getRole($db,$user->id)?></label>
        <?php
        $role = User::getRole($db, $user->id);
        if(strcmp($role, "client") != 0){ ?>
            <label id="closedticks"><span id="bold">TICKETS:</span> <?=User::getClosedTickets($db, $user->id)?></label>
        <?php }
        if($session->getID() == $user->id){ ?>
            <a href = "edit_profile.php?id=<?=$user->id?>"><button id="edit">EDIT</button></a>
        <?php } ?>
    </div>
</body>

<?php } ?>

<?php function drawEditProfile(PDO $db, User $user){ ?>
    <form action = "action_edit_profile.php" method = "post">
        <div class="profileedit">
            <img src="/profileImages/kaguya-sama-pelicula-min.jpg" id="pfp">
            <label id="usernamelabel">Username:</label>
            <input type="text" value="<?=$user->username?>" name="username" id="username">
            <label id="fullnamelabel">Full Name:</label>
            <input type="text" value="<?=$user->fullname?>" name="fullname" id="fullname">
            <label id="emaillabel">E-mail:</label>
            <input type="text" value="<?=$user->email?>" name="email" id="email">
            <label id="passwordlabel">Password:</label>
            <input type="password" name = "password" id="password">
            <input type="submit" id="edit" value="SAVE">
        </div>    
    </form>
<?php } ?>

<?php function drawUserInfo(User $user) { ?>
    <div class="ticket">
        <a href="profile.php?id=<?=$user->id?>"><label id="title"><?=$user->username?></label></a>
        <img id="config" src="/profileImages/gatito.png">
    </div>

<?php } ?>

<?php function drawUsers(array $users) { ?>
    <div class="list">
        <?php
        foreach($users as $user){
            drawUserInfo($user);
        }
        ?>
    </div>


</body>
<?php } ?>