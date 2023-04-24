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
    <?php $start = False; ?>
<?php } ?>

<?php function drawLogin() { ?>
    <body>
        <div class="login">
            <label id="namelabel">Username:</label> <br>
            <input type="text" id="name">
            <label id="passlabel">Password:</label> <br>
            <input type="text" id="pass">
            <input type="submit" value="ENTER">

        </div>
    </body>
    </html>
<?php } ?>

