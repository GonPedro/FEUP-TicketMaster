<?php

declare(strict_types = 1);
require_once(__DIR__ . "/session.php");

$session = new Session();

require_once(__DIR__ . "/database/connection.db.php");

$db = getDatabaseConnection();

require_once(__DIR__ . "/database/message.class.php");

$messages = Message::getMessages($db, (int)$_GET['id']);

require_once(__DIR__ . '/database/ticket.class.php');

$ticket = Ticket::getTicket($db, (int)$_GET['id']);

require_once(__DIR__ . "/common.tpl.php");
require_once(__DIR__ . "/ticket.tpl.php");
require_once(__DIR__ . '/database/user.class.php');

setHeader("Ticket");

if($session->isLoggedin()){
    drawTopbar($session);
    drawTicketInfo($ticket);
    $name = User::getName($db, $session->getID());
    $role = User::getRole($db, $session->getID());
    if((Ticket::checkAssignedAgent($db, (int)$_GET['id'], $name)) or ($role == "admin") or ($name == $ticket->client_name)){
        drawMessageInput();
        drawMessages($session, $messages);
    }
} else {
    header("Location : /index.php");
}


?>