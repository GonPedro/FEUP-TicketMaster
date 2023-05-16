<?php

declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
require_once(__DIR__ . '/database/message.class.php');
?>




<?php function drawMessages(Session $session, array $messages){ ?>
    <div class="msginput">
        <form action = "/action_add_message.php?id=<?=$_GET['id']?>" method = "post">
            <input type="text" name = "message">
            <input type="submit" value="Send">
        </form>
    </div>

    <div class="msglist">
        <?php foreach($messages as $message){
            if(strcmp($message->author, $session->getName()) == 0){ ?>
                <div class = "msg" id = "yours">    
                    <p id = "content"><?=$message->content?></p>
                    <div class ="extradata">
                        <label id="author">by <?=$message->author?></label>
                        <label id="date"><?=$message->date?></label>
                    </div>
                </div>
            <?php } else { ?>
                <div class = "msg">    
                    <p id = "content"><?=$message->content?></p>
                    <div class ="extradata">
                        <label id="author">by <?=$message->author?></label>
                        <label id="date"><?=$message->date?></label>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
<?php } ?>