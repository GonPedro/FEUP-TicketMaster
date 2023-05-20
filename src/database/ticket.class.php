<?php
declare(strict_types = 1);

require_once(__DIR__ . '/change.class.php');
require_once(__DIR__ . '/user.class.php');
require_once(__DIR__ . '/hashtag.class.php');

class Ticket{
    public int $id;
    public string $title;
    public string $client_name;
    public array $agents;
    public string $department;
    public array $hashtags;
    public string $status;
    public int $priority;
    public string $date;

    public function __construct(int $id, string $title, string $client_name , array $agents, string $department, array $hashtags, string $status, int $priority, string $date){
        $this->id = $id;
        $this->title = $title;
        $this->client_name = $client_name;
        $this->agents = $agents;
        $this->department = $department;
        $this->hashtags = $hashtags;
        $this->status = $status;
        $this->priority = $priority;
        $this->date = $date;
    }

    static function getTicket(PDO $db, int $id) : ?Ticket{
        $stmt = $db->prepare('SELECT ticketID, clientID, department, status_name, title, priority, da
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
            
            $hashtags = Hashtag::getTicketHashtags($db, (int)$ticket['ticketID']);
            
            //get Ticket Agents
            $agents = Ticket::getAgents($db, (int)$ticket['ticketID']);
        
            return new Ticket(
                (int)$ticket['ticketID'],
                $ticket['title'],
                $client_name['username'],
                $agents,
                $ticket['department'],
                $hashtags,
                $ticket['status_name'],
                (int)$ticket['priority'],
                $ticket['da']
        
            );
        } else return null;
    }

    static function checkAssignedAgent(PDO $db, int $ticket_id, string $agent) : ?bool{
        if(strcmp($agent,"") == 0) return true;
        $stmt = $db->prepare('SELECT agentID
        FROM TicketAgent
        WHERE ticketID = ?');
        $stmt->execute(array($ticket_id));
        $agents = $stmt->fetchAll();
        foreach($agents as $sub){
            $name = User::getName($db, (int)$sub['agentID']);
            if(strcmp($name,$agent) == 0){
                return true;
            }
        }
        return false;
    }

    static function getAgents(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT agentID
        FROM TicketAgent
        WHERE ticketID = ?');
        $agents = array();
        $stmt->execute(array($ticket_id));
        while($agent = $stmt->fetch()){
            $agents[] = User::getName($db, (int)$agent['agentID']);
        }
        return $agents;
    }

    static function getFilteredTickets(PDO $db, string $author, string $department, array $hashtag, string $status, string $date, int $priority, string $agent) : ?array{
        if(strcmp($author, "") == 0){
            $stmt = $db->prepare('SELECT ticketID, clientID, department, status_name, title, priority, da
            FROM Ticket
            Where department = ? AND status_name = ? AND priority = ?');
            $stmt->execute(array($department, $status, $priority));
        } else {
            $author_id = User::getID($db, $author);
            $stmt = $db->prepare('SELECT ticketID, clientID, department, status_name, title, priority, da
            FROM Ticket
            Where clientID = ? AND department = ? AND status_name = ? AND priority = ?');
            $stmt->execute(array($author_id, $department, $status, $priority));
        }
        $tickets = array();
        while($ticket = $stmt->fetch()){
            $date1 = DateTime::createFromFormat('Y-m-d H:i', $ticket['da']);
            if ($date1 instanceof DateTime) {
                $dateString1 = $date1->format('Y-m-d');
            } else {
                continue;
            }
            if(strcmp($date, "") == 0) $dateflag = true;
            $hashtags = Hashtag::getTicketHashtags($db, (int)$ticket['ticketID']);
            $flag = 1;
            $diff = array_diff($hashtag, $hashtags);
            if(empty($diff) or empty($hashtag)){
                $flag = 0;
            }
            if(Ticket::checkAssignedAgent($db, (int)$ticket['ticketID'], $agent) and ($dateString1 == $date or $dateflag) and $flag == 0){
                $tickets[] = new Ticket(
                    (int)$ticket['ticketID'],
                    $ticket['title'],
                    $author,
                    Ticket::getAgents($db, (int)$ticket['ticketID']),
                    $department,
                    $hashtags,
                    $status,
                    $priority,
                    $date1->format('Y-m-d H:i')
                );
            }

        }
        return $tickets;
    }

    static function addTicket(PDO $db, int $client_id, string $title, int $priority, string $department){
        $date = date("Y-m-d H:i");
        $stmt = $db->prepare('INSERT INTO Ticket(clientID, department, status_name, title, priority, da)
        VALUES (?,?,"open",?,?,?)');
        $stmt->execute(array($client_id, $department, $title, $priority, $date));
        return;
    }

    static function getTickets(PDO $db, int $client_id) :?array{
        $stmt = $db->prepare('SELECT ticketID, title
        FROM Ticket
        where clientID = ?');
        $stmt->execute(array($client_id));
        if($tickets = $stmt->fetchAll()){
            return $tickets;
        } else return array();
    }


    static function getTicketsFromDepartment(PDO $db, string $department) : ?array{
        $stmt = $db->prepare('SELECT ticketID, title
        FROM Ticket
        where department = ?');
        $stmt->execute(array($department));
        if($tickets = $stmt->fetchAll()){
            return $tickets;
        } else return array();
    }


    static function addAgent(PDO $db, int $ticket_id, int $agent_id){
        $stmt = $db->prepare('SELECT agentID
        FROM TicketAgent
        WHERE ticketID = ?');
        $stmt->execute(array($ticket_id));
        if(!$agent = $stmt->fetch()){
            Ticket::changeStatus($db, $ticket_id, "assigned");
            Change::addChange($db, $ticket_id, $agent_id, "Changed Status from " . $this->status . " to assigned");
        }
        $stmt = $db->prepare('INSERT INTO TicketAgent (ticketID, agentID) VALUES (?,?)');
        $stmt->execute(array($ticket_id, $agent_id));
        $name = User::getName($db, $agent_id);
        Change::addChange($db, $ticket_id, $agent_id, "Assigned " . $name . " to Ticket");
    }

    static function changeDepartment(PDO $db, int $ticket_id, int $agent_id, string $department){
        $stmt = $db->prepare('SELECT department
        FROM Ticket
        WHERE ticketID = ?');
        $stmt->execute(array($ticket_id));
        $depa = $stmt->fetch()['department'];
        
        $stmt = $db->prepare('UPDATE Ticket SET department = ?
        WHERE ticketID = ?');
        $stmt->execute(array($department, $ticket_id));
        Change::addChange($db, $ticket_id, $agent_id, "Changed from department " . $depa . " to " . $department);
    }

    static function changeStatus(PDO $db, int $ticket_id, int $agent_id, string $status){
        $stmt = $db->prepare('SELECT status_name
        FROM Ticket
        WHERE ticketID = ?');
        $stmt->execute(array($ticket_id));
        $sta = $stmt->fetch()['status_name'];

        $stmt = $db->prepare('UPDATE Ticket SET status_name = ?
        WHERE ticketID = ?');
        $stmt->execute(array($status, $ticket_id));
        Change::addChange($db, $ticket_id, $agent_id, "Changed Status from " . $sta . " to " . $status);
    }

    static function changePriority(PDO $db, int $ticket_id, int $agent_id, int $priority){
        $stmt = $db->prepare('SELECT priority
        FROM Ticket
        WHERE ticketID = ?');
        $stmt->execute(array($ticket_id));
        $prio = $stmt->fetch()['priority'];

        $stmt = $db->prepare('UPDATE Ticket SET priority = ?
        WHERE ticketID = ?');
        $stmt->execute(array($priority, $ticket_id));
        Change::addChange($db, $ticket_id, $agent_id, "Changed Priority from " . $prio . " to " . $priority);
    }
}
?>