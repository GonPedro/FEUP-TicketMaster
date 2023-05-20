<?php
declare(strict_types = 1);

require_once(__DIR__ . '/database/ticket.class.php');

require_once(__DIR__ . '/database/connection.db.php');
require_once(__DIR__ . '/common.tpl.php');

$db = getDatabaseConnection();

$hashtags = explode(',', $_POST['hashtag']);

$tickets = Ticket::getFilteredTickets($db, $_POST['author'], $_POST['department'], $hashtags, $_POST['status'], $_POST['date'], (int)$_POST['priority'], $_POST['agent']);

foreach($tickets as $ticket){
    drawFilteredTicket($ticket);
}
?>