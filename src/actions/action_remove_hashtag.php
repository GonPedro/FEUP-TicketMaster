<?php

declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');

$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/hashtag.class.php');

$db = getDatabaseConnection();

Hashtag::removeHashtag($db, (int)$_POST['ticketID'], (int)$_POST['hashtag']);

?>