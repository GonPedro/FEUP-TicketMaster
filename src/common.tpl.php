<?php
$start = TRUE;
?>
<?php function setHeader() { ?>
    <!DOCTYPE html>
    <html lang="en-US">
    
    <head>
        <title>Login - Ticketinator</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <link href="structure.css" rel="stylesheet">
    </head>
<?php } ?>


<?php function drawStart() { ?>
    <body>
        <div class="login">
            <a href="login.php"><input type="submit" value="LOGIN"></a>
            <input type="submit" value="SIGNUP">
        </div>
    </body>
    </html>
<?php } ?>

<?php function drawTickets(){ ?>
    <body>
    <div class="topbar">
        <button id="mticket">MY TICKETS</button>
        <button id="nticket">NEW TICKET</button>
        <button id="logout">LOG OUT</button>
    </div>


    <div class="list">
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>

        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>
        <div class="ticket">
            <label id="title">The Toilet Broke</label>
        </div>


    </div>

</body>

<?php } ?>

<?php function drawLogin() { ?>
    <body>
        <form action="/action_login.php" method="post" class="login">
            <label id="namelabel">Username:</label> <br>
            <input type="text" name = "username" placeholder = "Username" id="name">
            <label id="passlabel">Password:</label> <br>
            <input type="password" name = "password" placeholder = "Password" id="pass">
            <input type="submit" value="ENTER">

        </form>
    </body>
    </html>
<?php } ?>

