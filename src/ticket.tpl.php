<?php
declare(strict_types = 1);
require_once(__DIR__ . '/session.php');
require_once(__DIR__ . '/database/message.class.php');
require_once(__DIR__ . '/common.tpl.php');
require_once(__DIR__ . '/database/ticket.class.php');
require_once(__DIR__ . '/database/hashtag.class.php');
require_once(__DIR__ . '/database/department.class.php');
?>

<?php function drawTicketInfo(Ticket $ticket){ ?>
    <div class="ticketdata">
        <label id="title"><?=$ticket->title?></label>
        <div class="extradata">
            <label id="author"><span id="bold">BY:</span> <?=$ticket->client_name?></label>
            <label id="status"><span id="bold">STATUS:</span> <?=$ticket->status?></label>
            <label id="department"><span id="bold">DEPARTMENT:</span> <?=$ticket->department?></label>
        </div>
        <img id="confi" src="/profileImages/gatito.png">
    </div>
<?php } ?>

<?php function drawMessageInput() { ?>
    <div class="msginput">
    <form id ="messageForm" action = "/action_add_message.php?id=<?=$_GET['id']?>" method = "post">
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

<?php function drawTicketConfig(array $hashtags, array $agents, array $departments) { ?>
    <div class="ticketmenu">
        <div class="listinput" id="hashtags">
            <label id="name">Hashtags:</label>
            <input type="text">
            <div id="list">
                <?php
                foreach($hashtags as $hashtag){?>
                    <label><?=$hashtag->text?></label>
                <?php } ?>
            </div>
        </div>
        <div class="listinput" id="collaborators">
            <label id="name">Collaborators:</label>
            <input type="text">
            <div id="list">
                <?php
                foreach($agents as $agent){ ?>
                    <label><?=$agent->username?></label>
                <?php } ?>
            </div>
        </div>
        <div class="labels">
            <label id="status">Status:</label>
            <label id="department">Department:</label>
            <label id="priority">Priority:</label>
        </div>
        <div class="othersettings">
            <select id="status" name = "status">
                <?php
                foreach($statuses as $status) { ?>
                    <option value=<?=$status->name?>><?=$status->name?></option>
                <?php } ?>
            </select>
            <select id="department" name = "department">
                <?php
                foreach($departments as $department){ ?>
                    <option value=<?=$department->name?>><?=$department->name?></option>
                <?php } ?>
            </select>
            <select id="priority">
                <option value = "1">1</option>
                <option value = "2">2</option>
                <option value = "3">3</option>
                <option value = "4">4</option>
                <option value = "5">5</option>
                <option value = "6">6</option>
                <option value = "7">7</option>
                <option value = "8">8</option>
                <option value = "9">9</option>
                <option value = "10">10</option>
            </select>
        </div>

        <input type="submit" id="edit" value="SAVE">
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