<?php
class Change{
    public string $agent;
    public string $content;
    public DateTime $date;


    public function __construct(string $agent, string $content, DateTime $date){
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
            //format date
            $date_time = new DateTime($ticket['da']);
            $formated_date = $date_time->format('Y-m-d H:i:s');

            //get agent username
            $sub = $db->prepare('SELECT username
            FROM User
            where userID = ?');
            $sub->execute(array($change['agentID']));
            $agent = $sub->fetch();

            $changes[] = new Change(
                $agent,
                $change['content'],
                $formated_date
            );
        }
        return $changes;
    }
}