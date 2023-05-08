<?php
$start = TRUE;
?>
<?php function setHeader() { ?>
    <!DOCTYPE html>
    <html lang="en-US">
    
    <head>
        <title>Ticketinator</title>
        <meta charset="UTF-8">
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

<?php function drawTickets(){ ?>
    <div class="topbar">
        <a href = "/index.php"><button id="mticket">MY TICKETS</button></a>
        <button id="nticket">NEW TICKET</button>
        <form action = "/action_logout.php" method = "post" class = "logout">
            <button id="logout">LOG OUT</button>
        </form>
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

<?php function drawRegister(){ ?>
    <form action = "/action_register.php" method ="post" class = "login">
        <label id="rnamelabel">Username:</label> <br>
        <input type="text" name = "rname" id="rname">
        <label id="rmaillabel">E-mail:</label> <br>
        <input type="text" name ="rmail" id="rmail">
        <label id="rpasslabel">Password:</label> <br>
        <input type="password" name = "rpass" id="rpass">
        <label id="rpassrepeatlabel">Repeat Your Password:</label> <br>
        <input type="password" id="rpassrepeat">
        <input type="submit" value="ENTER">
    </form>
</body>
</html>
<?php } ?>

