<?php
class Ticket{
    public int $id;
    public string $title;
    public int $client_id;
    public array $agents;
    public string $department;
    public array $hashtags;
    public int $task;
    public int $priority;
    public DateTime $date;

public function __construct(int $id, string $title, int $client_id , array $agents, string $department, array $hashtags, int $task, int $priority, DateTime $date){
        $this->id = $id;
        $this->title = $title;
        $this->client_id = $client_id;
        $this->agents = $agents;
        $this->department = $department;
        $this->hashtags = $hashtags;
        $this->task = $task;
        $this->priority = $priority;
        $this->date = $date;
    }

}
?>