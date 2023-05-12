<?php

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
}