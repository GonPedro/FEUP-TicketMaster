<?php

declare(strict_types = 1);

require_once(__DIR__ . '/user.class.php');

class Message{
    public string $author;
    public string $content;
    public string $date;

    public function __construct(string $author, string $content, string $date){
        $this->author = $author;
        $this->content = $content;
        $this->date = $date;
    }


    static function addMessage(PDO $db, int $ticket_id, int $client_id, string $content){
        $date = date("Y-m-d H:i");
        $stmt = $db->prepare('INSERT INTO Message (userID,ticketID,da,content) VALUES (?,?,?,?)');
        $stmt->execute(array($client_id, $ticket_id, $date, $content));
        return;
    }

    static function getMessages(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT userID, da, content
        FROM Message
        WHERE ticketID = ?');
        $stmt->execute(array($ticket_id));
        $messages = array();
        while($message = $stmt->fetch()){
            //get author username
            $client = User::getName($db, (int)$message['userID']);

            $messages[] = new Message(
                $client,
                $message['content'],
                $message['da']
            );
        }
        return $messages;
    }
}

?>