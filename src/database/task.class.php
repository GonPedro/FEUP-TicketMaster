<?php
declare(strict_types = 1);

require_once(__DIR__ . '/user.class.php');

class Task{
    public int $id;
    public int $ticket_id;
    public string $creator;
    public string $content;

    public function __construct(int $id, int $ticket_id, string $creator, string $content){
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->creator = $creator;
        $this->content = $content;
    }

    static function getTasks(PDO $db){
        $stmt = $db->prepare('SELECT taskID, ticketID, agentID, content
        FROM Task');
        $stmt->execute();
        $tasks = array();
        while($task = $stmt->fetch()){
            $name = User::getName($db, $task['agentID']);
            $tasks[] = new Task(
                $task['departmentID'],
                $task['ticketID'],
                $name,
                $task['content']
            );
        }
    }

    static function assignAgent(PDO $db, int $agent, string $content){
        $agent_id = User::getID($db, $agent);
        $stmt = $db->prepare('INSERT INTO Task(agentID, content) VALUES (?,?)');
        $stmt->execute(array($agent_id ,$content));
    }

    static function assignTicket(PDO $db, int $ticket_id, string $content){
        $stmt = $db->prepare('INSERT INTO Task(ticketID, content) VALUES (?,?)');
        $stmt->execute(array($ticket_id ,$content));
    }
}

?>