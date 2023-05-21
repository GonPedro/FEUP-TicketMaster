<?php
declare(strict_types = 1);

require_once(__DIR__ . '/user.class.php');
require_once(__DIR__ . '/change.class.php');

class Hashtag {
    public int $id;
    public string $creator;
    public string $text;

    public function __construct(int $id, string $creator, string $text){
        $this->id = $id;
        $this->creator = $creator;
        $this->text = $text;
    }

    static function getTicketHashtags(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT Hashtag.hashtagID, adminID, name
        FROM Hashtag, TicketHashtag
        WHERE Hashtag.hashtagID = TicketHashtag.hashtagID AND TicketHashtag.ticketID = ?');
        $hashtags = array();
        $stmt->execute(array($ticket_id));
        while($hashtag = $stmt->fetch()){
            $name = User::getName($db, (int)$hashtag['adminID']);
            $hashtags[] = new Hashtag(
                (int)$hashtag['hashtagID'],
                $name,
                $hashtag['name']
            );
        }
        return $hashtags;
    }

    static function getHashtags(PDO $db) : ?array {
        $stmt = $db->prepare('SELECT hashtagID, adminID, name
        FROM Hashtag');
        $stmt->execute(array());
        $hashtags = array();
        while($hashtag = $stmt->fetch()){
            $name = User::getName($db, (int)$hashtag['adminID']);
            $hashtags[] = new Hashtag(
                (int)$hashtag['hashtagID'],
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


    static function addTicketHashtag(PDO $db, int $agent_id, int $ticket_id, string $hashtag){
        $hashtag_id = Hashtag::getHashtagID($db, $hashtag);
        $stmt = $db->prepare('INSERT INTO TicketHashtag(ticketID, hashtagID) VALUES (?,?)');
        $stmt->execute(array($ticket_id, $hashtag_id));
        Change::addChange($db, $ticket_id, $agent_id, "Added Hashtag " . $hashtag);
        return;
    }


    static function getHashtagID(PDO $db, string $name) : ?int{
        $stmt = $db->prepare('SELECT hashtagID
        FROM Hashtag
        WHERE name = ?');
        $stmt->execute(array($name));
        $hashtag = $stmt->fetch();
        $id = (int)$hashtag['hashtagID'];
        return $id;
    }

    static function checkName(PDO $db, string $name){
        $stmt = $db->prepare('SELECT name
        FROM Hashtag
        WHERE name = ?');
        $stmt->execute(array($name));
        if($hashtag = $stmt->fetch()){
            return false;
        } else return true;
    }

    static function removeHashtag(PDO $db, int $agent_id, int $ticket_id, string $hashtag){
        $hashtag_id = Hashtag::getHashtagID($db, $hashtag);
        $stmt = $db->prepare('DELETE FROM TicketHashtag WHERE ticketID = ? AND hashtagID = ?');
        $stmt->execute(array($ticket_id, $hashtag_id));
        Change::addChange($db, $ticket_id, $agent_id, "Removed Hashtag " . $hashtag);
        return;
    }

    static function getHashtagsWith(PDO $db, string $term) : ?array{
        $stmt = $db->prepare("SELECT name
        FROM Hashtag
        WHERE name LIKE ? || '%'");
        $result = array();
        $stmt->execute(array($term));
        while($hashtag = $stmt->fetch()){
            $result[] = $hashtag['name'];
        }
        return $result;
    }

    static function getTicketHashtagNames(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT name
        FROM Hashtag, TicketHashtag
        WHERE Hashtag.hashtagID = TicketHashtag.hashtagID AND TicketHashtag.ticketID = ?');
        $hashtags = array();
        $stmt->execute(array($ticket_id));
        while($hashtag = $stmt->fetch()){
            $hashtags[] = $hashtag['name'];
        }
        return $hashtags;
    }


    static function deleteHashtag(PDO $db, int $hashtag_id){
        $stmt = $db->prepare('DELETE FROM Hashtag WHERE hashtagID = ?');
        $stmt->execute(array($hashtag_id));
        return;
    }

}