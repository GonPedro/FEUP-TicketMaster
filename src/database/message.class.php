<?php

require_once(__DIR__ . '/user.class.php');

class Message{
    public string $author;
    public string $content;
    public DateTime $date;

    public function __construct(string $author, string $content, DateTime $date){
        $this->author = $author;
        $this->content = $content;
        $this->date = $date;
    }


    static function addMessage(PDO $db, int $ticket_id, int $client_id, string $content){
        date_default_timezone_set("Europe/Lisbon");
        $date = getDate();
        $date = date('Y-m-d H:i:s', $date);
        $stmt = $db->prepare('INSERT INTO Message (userID,ticketID,da,content) VALUES (?,?,?,?)');
        $stmt->execute(array($client_id, $ticket_id, $date, $content));
        return;
    }

    static function getMessages(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT userID, da, content
        FROM Message
        WHERE ticketID = ?
        ORDER BY da ASC');
        $stmt->execute(array($ticket_id));
        $messages = array();
        while($message = $stmt->fetch()){
            //format date
            $date_time = new DateTime($message['da']);
            $formated_date = $date_time->format('Y-m-d H:i:s');

            //get author username
            $client = User::getName($db, $message['userID']);

            $messages[] = new Message(
                $client,
                $message['content'],
                $formated_date
            );
        }
        return $messages;
    }
}

?>