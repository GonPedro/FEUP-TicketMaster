<?php
declare(strict_types = 1);

class Change {
    public string $agent;
    public string $content;
    public string $date;


    public function __construct(string $agent, string $content, string $date){
        $this->agent = $agent;
        $this->content = $content;
        $this->date = $date;
    }

    static function getChangestoTicket(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT agentID, content, da
        FROM Change
        Where ticketID = ?');
        $stmt->execute(array($ticket_id));

        $changes = array();
        while($change = $stmt->fetch()){
            //get agent username
            $sub = $db->prepare('SELECT username
            FROM User
            where userID = ?');
            $sub->execute(array($change['agentID']));
            $agent = $sub->fetch();

            $changes[] = new Change(
                $agent,
                $change['content'],
                $change['da']
            );
        }
        return $changes;
    }

    static function addChange(PDO $db, int $ticket_id, int $agent_id, string $content){
        $stmt = $db->prepare('INSERT INTO Change(agentID, ticketID, da, content) VALUES (?,?,?,?)');
        $date = date("Y-m-d H:i");
        $stmt->execute(array($agent_id, $ticket_id, $date, $content));
        return;  
    }
    
}