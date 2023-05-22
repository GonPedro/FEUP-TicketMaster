<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../database/ticket.class.php');

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

$db = getDatabaseConnection();


$tickets = Ticket::getFilteredTickets($db, $_POST['author'], $_POST['department'], $_POST['hashtag'], $_POST['status'], $_POST['date'], (int)$_POST['priority'], $_POST['agent']);

foreach($tickets as $ticket){
    drawFilteredTicket($ticket);
}
?>