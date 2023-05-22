<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../session.php');
    $session = new Session();
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/department.class.php');
    require_once(__DIR__ . '/../database/hashtag.class.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/status.class.php');
    require_once(__DIR__ . '/../templates/ticket.tpl.php');
    $db = getDatabaseConnection();
    Ticket::changeStatus($db, (int)$_POST['ticket'], $session->getID(), $_POST['status']);
    $statuses = Status::getStatuses($db);
    $departments = Department::getDepartments($db);
    $ticket = Ticket::getTicket($db, (int)$_POST['ticket']);
    drawTicketConfigRefresh($ticket, $departments, $statuses);

?>
