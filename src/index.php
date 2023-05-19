<?php 
declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
$session = new Session();
require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();
require_once(__DIR__ . '/common.tpl.php');


if(!$session->isLoggedin()){
    setHeader("Start");
    drawStart();
} 
else{
    setHeader("Tickets");
    drawTopbar();
    drawFilterBoxes();
    drawTickets($session);
}
?>

