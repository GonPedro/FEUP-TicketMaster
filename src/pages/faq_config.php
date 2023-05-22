<?php 
declare(strict_types = 1);

require_once(__DIR__ . '/../session.php');
$session = new Session();
require_once(__DIR__ . '/../database/connection.db.php');

$db = getDatabaseConnection();
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/faq.tpl.php');


if($session->isLoggedin()){
    setHeader("FAQ_config");
    drawTopbar($session);
    $faqs = Faq::getFaqs($db);
    drawFAQConfig($faqs);
} 
else{
    header('Location: /index.php');
}
?>