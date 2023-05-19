<?php
declare(strict_types = 1);

require_once(__DIR__ . '/user.class.php');

class Hashtag {
    public string $creator;
    public string $text;

    public function __construct(string $creator, string $text){
        $this->creator = $creator;
        $this->text = $text;
    }

    static function getTicketHashtags(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT adminID, name
        FROM Hashtag, TicketHashtag
        WHERE Hashtag.hashtagID = TicketHashtag.hashtagID AND TicketHashtag.ticketID = ?');
        $hashtags = array();
        $stmt->execute(array($ticket_id));
        while($hashtag = $stmt->fetch()){
            $name = User::getName($db, (int)$hashtag['adminID']);
            $hashtags[] = new Hashtag(
                $name,
                $hashtag['name']
            );
        }
        return $hashtags;
    }

    static function addHashtag(PDO $db, int $admin_id, string $name){
        $stmt = $db->prepare('INSERT INTO Hashtag(adminID, name) VALUES (?,?)');
        $stmt->execute(array($admin_id, $name));
        return;
    }
}