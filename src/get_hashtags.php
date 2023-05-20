<?php
declare(strict_types = 1);

require_once(__DIR__. '/database/connection.db.php');
$db = getDatabaseConnection();

require_once(__DIR__ . '/database/hashtag.class.php');

$options = Hashtag::getHashtagsWith($db, $_POST['search']);

header('Content-Type: application/json');
echo json_encode($options);

?>