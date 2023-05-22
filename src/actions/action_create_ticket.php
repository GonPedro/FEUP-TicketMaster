<?php

declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');

$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/ticket.class.php');

$db = getDatabaseConnection();

Ticket::addTicket($db, $session->getID(),$_POST['title'], (int)$_POST['priority'], $_POST['department']);

header('Location: /index.php');

?>
