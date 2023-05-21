<?php
declare(strict_types = 1);

require_once(__DIR__. '/database/connection.db.php');
$db = getDatabaseConnection();

require_once(__DIR__ . '/database/hashtag.class.php');

$first = Hashtag::getHashtagsWith($db, $_POST['search']);
$ticket_hashtags = Hashtag::getTicketHashtagNames($db, (int)$_POST['ticket']);
$options = array_diff($first, $ticket_hashtags);

header('Content-Type: application/json');
echo json_encode($options);

?>