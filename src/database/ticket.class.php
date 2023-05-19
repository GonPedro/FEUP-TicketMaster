<?php
declare(strict_types = 1);

require_once(__DIR__ . '/change.class.php');
require_once(__DIR__ . '/user.class.php');

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

    static function addTicket(PDO $db, int $client_id, string $title, int $priority, string $department){
        $date = date("Y-m-d H:i");
        $stmt = $db->prepare('INSERT INTO Ticket(clientID, department, status_name, title, priority, da)
        VALUES (?,?,"open",?,?,?)');
        $stmt->execute(array($client_id, $department, $title, $priority, $date));
        //probably still need to insert hashtags into database as well, dont know how i will do that yet
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


    static function getAgents(PDO $db, int $ticket_id) : ?array{
        $stmt = $db->prepare('SELECT agentID
        FROM TicketAgent
        WHERE ticketID = ?');
        $stmt->execute(array($ticket_id));
        if($agents = $stmt->fetchAll()){
            return $agents;
        } else return array();
    }


    static function changeDepartment(PDO $db, int $ticket_id, int $agent_id, string $department){
        $stmt = $db->prepare('UPDATE Ticket SET department = ?
        WHERE ticketID = ?');
        $stmt->execute(array($department, $ticket_id));
        Change::addChange($db, $ticket_id, $agent_id, "Changed from department " . $this->department . " to " . $department);
    }

    static function changeStatus(PDO $db, int $ticket_id, string $status){
        $stmt = $db->prepare('UPDATE Ticket SET status_name = ?');
        $stmt->execute(array($status));
    }
}
?>