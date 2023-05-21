<?php
declare(strict_types = 1);

require_once(__DIR__. '/database/connection.db.php');
$db = getDatabaseConnection();

require_once(__DIR__ . '/database/hashtag.class.php');

$id = Hashtag::getHashtagID($db, $_POST['hashtag']);

header('Content-Type: application/json');
echo json_encode($id);

?>