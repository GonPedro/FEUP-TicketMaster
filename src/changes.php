<?php

declare(strict_types = 1);
require_once(__DIR__ . "/session.php");

$session = new Session();

require_once(__DIR__ . "/database/connection.db.php");

$db = getDatabaseConnection();

require_once(__DIR__ . "/database/change.class.php");

$changes = Change::getChangestoTicket($db, (int)$_GET['id']);

require_once(__DIR__ . '/database/ticket.class.php');

$ticket = Ticket::getTicket($db, (int)$_GET['id']);

require_once(__DIR__ . "/common.tpl.php");
require_once(__DIR__ . "/ticket.tpl.php");
require_once(__DIR__ . '/database/user.class.php');

setHeader("Ticket Changes");

if($session->isLoggedin()){
    drawTopbar($session);
    drawChangesTicketInfo($ticket);
    $name = User::getName($db, $session->getID());
    $role = User::getRole($db, $session->getID());
    if((Ticket::checkAssignedAgent($db, (int)$_GET['id'], $name)) or ($role == "admin")){
        drawTicketChanges($changes);
    }
} else {
    header("Location : /index.php");
}


?>