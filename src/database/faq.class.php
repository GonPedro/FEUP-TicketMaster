<?php

declare(strict_types = 1);
require_once(__DIR__ . '/user.class.php');

class Faq{
    public int $id;
    public string $creator;
    public string $title;
    public string $content;

    public function __construct(int $id, string $creator, string $title, string $content){
        $this->id = $id;
        $this->creator = $creator;
        $this->title = $title;
        $this->content = $content;
    }

    static function getFaqs(PDO $db) : ?array{
        $stmt = $db->prepare('SELECT faqID, userID, title, content
        FROM FAQ');
        $faqs = array();
        $stmt->execute(array());
        while($faq = $stmt->fetch()){
            $name = User::getName($db, (int)$faq['userID']);
            $faqs[] = new Faq(
                (int)$faq['faqID'],
                $name,
                $faq['title'],
                $faq['content']
            );
        } 
        return $faqs;
    }

    static function addFaq(PDO $db, int $admin_id, string $title, string $content){
        $stmt = $db->prepare('INSERT INTO FAQ(userID, title, content) VALUES (?,?,?)');
        $stmt->execute(array($admin_id, $title, $content));
        return;
    }

    static function removeFaq(PDO $db, int $id){
        $stmt = $db->prepare('DELETE FROM FAQ WHERE faqID = ?');
        $stmt->execute(array($id));
        return;
    }
}

?>