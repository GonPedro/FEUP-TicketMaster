<?php 
declare(strict_types = 1);

require_once(__DIR__ . '/session.php');
$session = new Session();
require_once(__DIR__ . '/database/connection.db.php');

$db = getDatabaseConnection();
require_once(__DIR__ . '/common.tpl.php');
require_once(__DIR__ . '/faq.tpl.php');
require_once(__DIR__ . '/database/user.class.php');


if($session->isLoggedin()){
    setHeader("FAQs");
    drawTopbar($session);
    $faqs = Faq::getFaqs($db);
    $role = User::getRole($db, $session->getID());
    drawFAQs($faqs, $role);
} 
else{
    header('Location: /index.php');
}
?>