<?php

declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
require_once(__DIR__ . '/database/ticket.class.php');
require_once(__DIR__ . '/database/connection.db.php');
require_once(__DIR__ . '/database/department.class.php');
require_once(__DIR__ . '/database/status.class.php');
require_once(__DIR__ . '/database/hashtag.class.php');


?>


<?php function setHeader(string $topic) { ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <title><?=$topic?> - Ticketinator</title>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="script.js"></script>
        <link href="style.css" rel="stylesheet">
        <link href="structure.css" rel="stylesheet">
    </head>
    <body>
<?php } ?>


<?php function drawStart() { ?>
    <div class="login">
        <a href="login.php"><input type="submit" value="LOGIN"></a>
        <a href = "register.php"><input type="submit" value="SIGNUP"></a>
    </div>
    </body>
    </html>
<?php } ?>


<?php function drawTicket(array $ticket){ ?>
    <div class="ticket">
        <a href="ticket.php?id=<?=$ticket['ticketID']?>"><label id="title"><?=$ticket['title']?></label></a>
        <img id="config" src="/profileImages/gatito.png">
    </div>
<?php } ?> 

<?php function drawFilteredTicket(Ticket $ticket) { ?>
    <div class="ticket">
        <a href="ticket.php?id=<?=$ticket->id?>"><label id="title"><?=$ticket->title?></label></a>
        <img id="config" src="/profileImages/gatito.png">
    </div>
<?php } ?>



<?php function drawTopbar(){ ?>
    <div class="topbar">
        <button id="mticket"> <a href = "index.php">MY TICKETS</a></button>
        <button id="nticket"><a href = "create.php">NEW TICKET</a></button>
        <form action = "/action_logout.php" method = "post">
            <button id="logout">LOG OUT</button>
        </form>
    </div>
<?php } ?>


<?php function drawTickets(Session $session){ ?>
    <div id ="list" class="list">
        <?php
        $db = getDatabaseConnection();
        $tickets = Ticket::getTickets($db, $session->getID());
        foreach($tickets as $ticket){
            drawTicket($ticket);
        }
        ?>
    </div>


</body>

<?php } ?>

<?php function drawFilterBoxes(){ ?>
    <form id ="ticketFilter" action = "/action_filter_tickets.php" method = "post">
        <div class="filterlabels" id="row1">
            <label>Author:</label>
            <label>Department:</label>
            <label>Hashtag:</label>
            <label></label>
        </div>
        <div class="filterboxes" id = "row1">
            <input type="text" name = "author">
            <select id="a" name = "department">
                <?php
                $db = getDatabaseConnection();
                $departments = Department::getDepartments($db);
                foreach($departments as $department) { ?>
                    <option value =<?=$department->name?>><?=$department->name?></option>
                <?php } ?>
            </select>
            <input type="text" name = "hashtag">
            <input type="submit" value="Search">

        </div>
        <div class="filterlabels" id="row2">
            <label>Status:</label>
            <label>Date:</label>
            <label>Priority:</label>
            <label>Assigned Agent:</label>
        </div>
        <div class="filterboxes" id="row2">
            <select id="b" name = "status">
                <?php 
                $statuses = Status::getStatuses($db);
                foreach($statuses as $status){ ?>
                    <option value =<?=$status->name?>><?=$status->name?></option>
                <?php } ?>
            </select>
            <input type="date" name = "date">
            <select id="priority" name = "priority">
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
            <input type="text" name = "agent">
        </div>
        </div>
    </form>
<?php } ?>

<?php function drawLogin() { ?>
    <form action="/action_login.php" method="post" class="login">
        <label id="namelabel">Username:</label> <br>
        <input type="text" name = "username" placeholder = "Username" id="name" required>
        <label id="passlabel">Password:</label> <br>
        <input type="password" name = "password" placeholder = "Password" id="pass" required>
        <input type="submit" value="ENTER">
    </form>
    </body>
    </html>
<?php } ?>

<?php function drawRegister(){ ?>
    <form action = "/action_register.php" method ="post" class = "login">
        <label id="rnamelabel">Username:</label> <br>
        <input type="text" name = "rname" id="rname" required>
        <label id="rmaillabel">E-mail:</label> <br>
        <input type="text" name ="rmail" id="rmail" required>
        <label id="rpasslabel">Password:</label> <br>
        <input type="password" name = "rpass" id="rpass" required>
        <label id="rpassrepeatlabel">Repeat Your Password:</label> <br>
        <input type="password" name = "rpassrepeat" id="rpassrepeat" required>
        <input type="submit" value="ENTER">
    </form>
</body>
</html>
<?php } ?>



<?php function drawTicketForm(){ ?>
    <form action = "/action_create_ticket.php" method ="post" class = "create">
        <div class="config"> 
            <label id="titlelabel">Ticket Name:</label>
            <input type="text" name = "title" id="title">
            <label id="departmentlabel">Department:</label>
            <select id="department" name = "department">
                <option value = "none">-- Select the Department --</option>
                <?php
                $db = getDatabaseConnection();
                $departments = Department::getDepartments($db);
                foreach($departments as $department){ ?>
                    <option value = <?=$department->name?>><?=$department->name?></option>
                <?php } ?>
            </select>
            <label id="prioritylabel">Priority:</label>
            <select id="priority" name = "priority">
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
            <input type="submit" value="CREATE">
        </div>
    </form>
</body>

<?php } ?>

