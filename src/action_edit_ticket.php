<?php 
declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
$session = new Session();

require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/database/ticket.class.php');
require_once(__DIR__ . '/database/user.class.php');
require_once(__DIR__ . '/database/hashtag.class.php');


if(User::findName($db, $_POST['agent'])){
    if(!Ticket::checkAssignedAgent($db, (int)$_GET['id'], $_POST['agent'])){
        Ticket::addAgent($db, (int)$_GET['id'], User::getID($db, $_POST['agent']));
    } else {
        Ticket::removeAgent($db, (int)$_GET['id'], User::getID($db, $_POST['agent']));
    }
} else {
    header('Location :' . $_SERVER['HTTP_REFERER']);
}

if(!Hashtag::checkName($db, $_POST['hashtag'])){
    $flag = 1;
    $hashtags = Hashtag::getTicketHashtagNames($db, (int)$_GET['id']);
    foreach($hashtags as $hashtag){
        if($hashtag == $_POST['hashtag']){
            $flag = 0;
        }
    }
    if($flag == 1){
        Hashtag::addTicketHashtag($db, $session->getID(), (int)$_GET['id'], $_POST['hashtag']);
    } else {
        Hashtag::removeHashtag($db, $session->getID(), (int)$_GET['id'], $_POST['hashtag']);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

