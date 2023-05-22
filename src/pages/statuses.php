<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../database/status.class.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/status.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/session.php');

$session = new Session();

setHeader('Statuses');
if($session->isLoggedIn()){
    drawTopbar($session);
    $statuses = Status::getStatuses($db);
    drawStatuses($session,$statuses);
} else header('Location : /index.php');
