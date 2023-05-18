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

setHeader("Ticket");

if($session->isLoggedin()){
    drawTopbar();
    drawTicketInfo($ticket);
    drawMessageInput();
    drawMessages($session, $messages);
} else {
    header("Location : /index.php");
}


?>