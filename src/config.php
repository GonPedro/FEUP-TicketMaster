<?php
declare(strict_types = 1);

require_once(__DIR__ . '/session.php');

$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/ticket.tpl.php');
require_once(__DIR__ . '/common.tpl.php');
require_once(__DIR__ . '/database/department.class.php');
require_once(__DIR__ . '/database/hashtag.class.php');
require_once(__DIR__ . '/database/ticket.class.php');
require_once(__DIR__ . '/database/status.class.php');

setHeader("Ticket Config");
if($session->isLoggedIn()){
    drawTopbar($session);
    $statuses = Status::getStatuses($db);
    $departments = Department::getDepartments($db);
    $ticket = Ticket::getTicket($db, (int)$_GET['id']);
    drawTicketConfig($ticket, $departments, $statuses);
} else {
    header('Location : /index.php');
}
?>
