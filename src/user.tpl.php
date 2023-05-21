<?php
declare(strict_types = 1);


require_once(__DIR__ . "/database/user.class.php");
require_once(__DIR__ . "/database/connection.db.php");
require_once(__DIR__ . "/session.php");
?>


<?php function drawProfile(PDO $db, Session $session, User $user) { ?>
    <div class="profile">
        <img src="/profileImages/gatito.png" id="pfp">
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
        <form action = "/action_logout.php" method = "post">
            <button id="logout">LOG OUT</button>
        </form>
    </div>
</body>

<?php } ?>

<?php function drawEditProfile(PDO $db, User $user){ ?>
    <form action = "action_edit_profile.php" method = "post">
        <div class="profileedit">
            <img src="/profileImages/gatito.png" id="pfp">
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

<?php function drawUserInfo(Session $session, User $user) { ?>
    <div class="ticket">
        <label id="title"><a href = "profile.php?id=<?=$user->id?>"><?=$user->username?></a></label>
        <?php
        $db = getDatabaseConnection();
        if((strcmp(User::getRole($db, (int)$session->getID()), "admin") == 0) and ($session->getID() != $user->id)){ 
            $userRole = User::getRole($db, $user->id); ?>
            <form id = "roleChange" action = "/action_promote_user.php" method = "post">
                <select name = "role" onchange = "changeRole(this)">
                    <option value="client" <?php if($userRole == "client") echo "selected"; ?>>Client</option>
                    <option value="agent" <?php if($userRole == "agent") echo "selected"; ?>>Agent</option>
                    <option value="admin" <?php if($userRole == "admin") echo "selected"; ?>>Admin</option>
                </select>
                <input type="hidden" name="user" value= <?=$user->id?>>
            </form>
        <?php } ?>
    </div>

<?php } ?>

<?php function drawUsers(Session $session, array $users) { ?>
    <div class="userinput">
        <form id = "searchUser" action = "/action_search_user.php" method = "post">
                <input type="text" name = "user">
                <input type="submit" value="Search">
        </form>
    </div>
    
    <div id = "userlist" class="userlist">
        <?php
        foreach($users as $user){
            drawUserInfo($session, $user);
        }
        ?>
    </div>


</body>
<?php } ?>