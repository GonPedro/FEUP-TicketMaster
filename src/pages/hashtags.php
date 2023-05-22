<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../database/hashtag.class.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/hashtag.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/session.php');

$session = new Session();

setHeader('Hashtags');
if($session->isLoggedIn()){
    drawTopbar($session);
    $hashtags = Hashtag::getHashtags($db);
    drawHashtags($session,$hashtags);
} else header('Location : /index.php');
