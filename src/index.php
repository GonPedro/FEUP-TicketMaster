<?php 
declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
$session = new Session();
require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();
require_once(__DIR__ . '/common.tpl.php');


setHeader();
if(!$session->isLoggedin()) drawStart();
else drawTickets();
?>

