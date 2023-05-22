<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');

$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/../templates/ticket.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/hashtag.class.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/status.class.php');
require_once(__DIR__ . '/../database/user.class.php');

setHeader("Ticket Config");
if($session->isLoggedIn()){
    drawTopbar($session);
    $statuses = Status::getStatuses($db);
    $departments = Department::getDepartments($db);
    $ticket = Ticket::getTicket($db, (int)$_GET['id']);
    $role = User::getRole($db, $session->getID());
    drawTicketConfig($role, $ticket, $departments, $statuses);
} else {
    header('Location : /index.php');
}
?>
