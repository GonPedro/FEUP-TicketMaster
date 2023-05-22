<?php

declare(strict_types = 1);

require_once(__DIR__ . "/../session.php");

require_once(__DIR__ . "/../database/connection.db.php");

require_once(__DIR__ . "/../database/hashtag.class.php");
require_once(__DIR__ . "/../database/user.class.php");

?>

<?php function drawHashtags(Session $session, array $hashtags) { ?>
    <?php
    $db = getDatabaseConnection();
    $role = User::getRole($db, $session->getID());
    if($role == "admin"){ ?>
        <form action = "../actions/action_create_hashtag.php" method = "post">
            <div class="userinput">
                <input type="text" name ="hashtag">
                <input type="submit" value="Add">
            </div>
        </form>
   <?php } ?>
   

    <div class = "userlist">
        <?php
        foreach($hashtags as $hashtag) { ?>
            <div class = "ticket">
                <label id="name"><?=$hashtag->text?></label>
                <form action = "../actions/action_delete_hashtag.php?id=<?=$hashtag->id?>" method = "post">
                    <button id="remove">X</button>
                </form>
            </div>
        <?php } ?>
    </div>
<?php } ?>