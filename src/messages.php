<?php

declare(strict_types = 1);
require_once(__DIR__ . "/session.php");

$session = new Session();

require_once(__DIR__ . "/database/connection.db.php");

$db = getDatabaseConnection();

require_once(__DIR__ . "/database/message.class.php");

$messages = Message::getMessages($db, (int)$_GET['id']);

require_once(__DIR__ . "/common.tpl.php");
require_once(__DIR__ . "/message.tpl.php");

setHeader("Messages");
drawTopbar();
drawMessages($session, $messages);

?>