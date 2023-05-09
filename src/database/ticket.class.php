<?php
class Ticket{
    public int $id;
    public string $title;
    public string $client_name;
    public array $agents;
    public string $department;
    public array $hashtags;
    public string $status;
    public int $task;
    public int $priority;
    public DateTime $date;

    public function __construct(int $id, string $title, int $client_name , array $agents, string $department, array $hashtags, string $status, int $task, int $priority, DateTime $date){
        $this->id = $id;
        $this->title = $title;
        $this->client_name = $client_name;
        $this->agents = $agents;
        $this->department = $department;
        $this->hashtags = $hashtags;
        $this->status = $status;
        $this->task = $task;
        $this->priority = $priority;
        $this->date = $date;
    }

    static function getTicket(PDO $db, int $id) : ?Ticket{
        $stmt = $db->prepare('SELECT ticketID, clientID, departmentID, taskID, status_name, title, priority, da
        FROM Ticket
        Where ticketID = ?');
        $stmt->execute(array($id));
        if($ticket = $stmt->fetch()){
            //get client username
            $stmt = $db->prepare('SELECT username
            FROM User
            Where userID = ?');
            $stmt->execute(array($ticket['clientID']));
            $client_name = $stmt->fetch();

            //get Department name
            $stmt = $db->prepare('SELECT name
            FROM Department
            Where departmentID = ?');
            $stmt->execute(array($ticket['departmentID']));
            $department_name = $stmt->fetch();
            
            //get Ticket Hashtags
            $stmt = $db->prepare('SELECT hashtagID
            FROM TicketHashtag
            Where ticketID = ?');
            $stmt->execute(array($id));
            $sub = $stmt->fetchAll();
            $hashtags = array();
            $index = 0;
            foreach($sub as $hashtag){
                $stmt = $db->prepare('SELECT name
                FROM Hashtag
                Where hashtagID = ?');
                $stmt->execute(array($hashtag));
                $tag = $stmt->fetch();
                $hashtags[$index] = $tag['name'];
                $index = $index + 1;
            }
            
            //get Ticket Agents
            $stmt = $db->prepare('SELECT agentID
            FROM TicketAgent
            Where ticketID = ?');
            $stmt->execute(array($id));
            $sub = $stmt->fetchAll();
            $agents = array();
            $index = 0;
            foreach($sub as $agent){
                $stmt = $db->prepare('SELECT username
                FROM User
                Where userID = ?');
                $stmt->execute(array($agent));
                $a = $stmt->fetch();
                $agents[$index] = $a['username'];
                $index = $index + 1;
            }

            //format date
            $date_time = new DateTime($ticket['da']);
            $formated_date = $date_time->format('d/m/y H:i');
            return new Ticket(
                $ticket['ticketID'],
                $ticket['title'],
                $ticket['client_name'],
                $agents,
                $department_name,
                $hashtags,
                $ticket['status_name'],
                $ticket['taskID'],
                $ticket['priority'],
                $formated_date
        
            );
        }
    }
}
?>