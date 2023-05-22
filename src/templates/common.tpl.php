<?php

declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/status.class.php');
require_once(__DIR__ . '/../database/hashtag.class.php');


?>


<?php function setHeader(string $topic) { ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <title><?=$topic?> - Ticketinator</title>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../javascript/script.js"></script>
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/structure.css" rel="stylesheet">
    </head>
    <body>
<?php } ?>


<?php function drawStart() { ?>
    <div class="login">
        <a href="../pages/login.php"><input type="submit" value="LOGIN"></a>
        <a href = "../pages/register.php"><input type="submit" value="SIGNUP"></a>
    </div>
    </body>
    </html>
<?php } ?>


<?php function drawTicket(array $ticket){ ?>
    <div class="ticket">
        <label id="title"><a href="../pages/ticket.php?id=<?=$ticket['ticketID']?>"><?=$ticket['title']?></a></label>
        <a href = "../pages/config.php?id=<?=$ticket->id?>"><img id="config" src="/profileImages/gear.png"></a>
    </div>
<?php } ?> 

<?php function drawFilteredTicket(Ticket $ticket) { ?>
    <div class="ticket">
        <a href="../pages/ticket.php?id=<?=$ticket->id?>"><label id="title"><?=$ticket->title?></label></a>
        <a href = "../pages/config.php?id=<?=$ticket->id?>"><img id="config" src="/profileImages/gear.png"></a>
    </div>
<?php } ?>



<?php function drawTopbar(Session $session){ ?>
    <div class="topbar">
        <?php 
        $db = getDatabaseConnection();
        $role = User::getRole($db, $session->getID());
        if($role == "admin"){ ?>
            <button id="a"><a href = "../pages/admin.php">ADMIN</a></button>
        <?php } ?>
        <button id="faq"><a href = "../pages/faqs.php">FAQ</a></button>
        <button id="nticket"><a href = "../pages/users.php">USER SEARCH</a></button>
        <button id="mticket"><a href = "../index.php">TICKETS</a></button>
        <button id="nticket"><a href = "../pages/profile.php?id=<?=$session->getID()?>">PROFILE</a></button>
    </div>
<?php } ?>


<?php function drawTickets(Session $session){ ?>
    <div id ="list" class="list">
        <?php
        $db = getDatabaseConnection();
        $role = User::getRole($db, $session->getID());
        if($role == "client"){
            $tickets = Ticket::getTickets($db, $session->getID());
        } else if($role == "agent"){
            $tickets = Ticket::getAgentTickets($db, $session->getID());
        } else {
            $tickets = Ticket::getAllTickets($db);
        }
        foreach($tickets as $ticket){
            drawTicket($ticket);
        }
        ?>
    </div>
    <button class="new"><a href = "../pages/create.php">+</a></button>
</body>

<?php } ?>

<?php function drawFilterBoxes(){ ?>
    <form id ="ticketFilter" action = "../actions/action_filter_tickets.php" method = "post">
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
            <input type="text" id="hashtag-input">
            <div id="autocomplete-results"></div>
            <div id="selected-hashtags" class="selected-hashtag"></div>
            <input type="hidden" name="hashtag" class = "hashtag-input">
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
        <input type="email" name ="rmail" id="rmail" required>
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
    <form action = "../actions/action_create_ticket.php" method ="post" class = "create">
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


<?php function drawAdminButtons(){?>
    <div class="buttonlist">
        <button><a href = "../pages/departments.php">Departments</a></button>
        <button><a href = "../pages/statuses.php">Status</a></button>
        <button><a href = "../pages/hashtags.php">Hashtags</a></button>
    </div>

</body>

<?php } ?>

