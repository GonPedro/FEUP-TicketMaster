<?php
declare(strict_types = 1);
require_once(__DIR__ . '/session.php');
require_once(__DIR__ . '/database/message.class.php');
require_once(__DIR__ . '/common.tpl.php');
require_once(__DIR__ . '/database/ticket.class.php');
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