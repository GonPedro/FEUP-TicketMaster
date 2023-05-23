<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../session.php');
require_once(__DIR__ . '/../database/message.class.php');
require_once(__DIR__ . '/common.tpl.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/hashtag.class.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/change.class.php');
?>

<?php function drawTicketInfo(Ticket $ticket){ ?>
    <div class="ticketdata">
        <label id="title"><?=$ticket->title?></label>
        <div class="extradata">
            <label id="author"><span id="bold">BY:</span> <?=$ticket->client_name?></label>
            <label id="status"><span id="bold">STATUS:</span> <?=$ticket->status?></label>
            <label id="department"><span id="bold">DEPARTMENT:</span> <?=$ticket->department?></label>
        </div>
        <a href = "../pages/config.php?id=<?=$ticket->id?>"><img id="confi" src="/profileImages/gear.png"></a>
        <a href = "../pages/changes.php?id=<?=$ticket->id?>"><img id="actions" src="../profileImages/action.png"></a>
    </div>
<?php } ?>

<?php function drawChangesTicketInfo(Ticket $ticket){ ?>
    <div class="ticketdata">
        <label id="title"><?=$ticket->title?></label>
        <div class="extradata">
            <label id="author"><span id="bold">BY:</span> <?=$ticket->client_name?></label>
            <label id="status"><span id="bold">STATUS:</span> <?=$ticket->status?></label>
            <label id="department"><span id="bold">DEPARTMENT:</span> <?=$ticket->department?></label>
        </div>
        <a href = "../pages/config.php?id=<?=$ticket->id?>"><img id="confi" src="/profileImages/gear.png"></a>
        <a href = "../pages/ticket.php?id=<?=$ticket->id?>"><img id="actions" src="../profileImages/action.png"></a>
    </div>
<?php } ?>



<?php function drawMessageInput() { ?>
    <div class="userinput" id = "msginput">
    <form id ="messageForm" action = "/../actions/action_add_message.php?id=<?=$_GET['id']?>" method = "post">
        <input type="text" name = "message">
        <input type="submit" value="Send">
    </form>
</div>
<?php } ?>

<?php function drawMessages(Session $session, array $messages){ ?>
    <div id ="msglist" class="msglist">
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


<?php function drawRefreshedMessages(Session $session, array $messages) {
    foreach($messages as $message){
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
    } 
} ?>


<?php function drawTicketChanges(array $changes){ ?>
    <div class="msglist">
        <?php foreach($changes as $change){?>
            <div class="msg">
                <p id="content "><?=$change->content?></p>
                <div class="extradata">
                    <label id="author">by <?=$change->agent?></label>
                    <label id="date"><?=$change->date?></label>
                </div>
             </div>
        <?php } ?>

    </div>

</body>

<?php } ?>

<?php function drawTicketConfig(string $role, Ticket $ticket, array $departments, array $statuses) { ?>
    <div id = "ticketmenu" class="ticketmenu">
        <form action = "../actions/action_edit_ticket.php?id=<?=$ticket->id?>" method = "post">
        <div class="listinput" id="hashtags">
            <label id="name">Hashtags:</label>
            <input type="text" id="hashtag-ticket-input" name = "hashtag">
            <div id="list">
                <?php
                foreach($ticket->hashtags as $hashtag){?>
                <label class="hashtag-label" data-ticket-id="<?=$ticket->id?>"  data-hashtag-id="<?=$hashtag->id?>">#<?=$hashtag->text?></label>
                <?php } ?>
            </div>
        </div>
        <?php
        if($role != "client"){ ?>
        <div class="listinput" id="collaborators">
            <label id="name">Collaborators:</label>
            <input type="text" name = "agent">
            <div id="list">
                <?php
                foreach($ticket->agents as $agent){ ?>
                    <label><?=$agent?></label>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        
        <div class="labels">
            <label id="status">Status:</label>
            <label id="department">Department:</label>
            <label id="priority">Priority:</label>
        </div>
        <div class="othersettings">
            <select id="status" name = "status">
                <?php
                foreach($statuses as $status) { ?>
                    <option value=<?=$status->name?> <?php if ($status->name == $ticket->status) echo "selected";?>><?=$status->name?></option>
                <?php } ?>
            </select>
            <select id="department" name = "department">
                <?php
                foreach($departments as $department){ ?>
                    <option value=<?=$department->name?> <?php if ($department->name == $ticket->department) echo "selected";?>><?=$department->name?></option>
                <?php } ?>
            </select>
            <select id="priority" name = "priority">
                <option value = "1" <?php if ($ticket->priority == 1) echo "selected";?>>1</option>
                <option value = "2" <?php if ($ticket->priority == 2) echo "selected";?>>2</option>
                <option value = "3" <?php if ($ticket->priority == 3) echo "selected";?>>3</option>
                <option value = "4" <?php if ($ticket->priority == 4) echo "selected";?>>4</option>
                <option value = "5" <?php if ($ticket->priority == 5) echo "selected";?>>5</option>
                <option value = "6" <?php if ($ticket->priority == 6) echo "selected";?>>6</option>
                <option value = "7" <?php if ($ticket->priority == 7) echo "selected";?>>7</option>
                <option value = "8" <?php if ($ticket->priority == 8) echo "selected";?>>8</option>
                <option value = "9" <?php if ($ticket->priority == 9) echo "selected";?>>9</option>
                <option value = "10" <?php if ($ticket->priority == 10) echo "selected";?>>10</option>
            </select>
        </div>
        <input type="submit" id="edit" value="SAVE">
        </form>
    </div>
</body>

<?php } ?>



<?php function drawDepartmentTickets(string $department) { ?>
    <div class="list">
        <?php
        $db = getDatabaseConnection();
        $tickets = Ticket::getTicketsFromDepartment($db, $department);
        foreach($tickets as $ticket){
           drawTicket($ticket);
        }
        ?>
    </div>
<?php } ?>