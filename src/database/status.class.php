<?php

declare(strict_types = 1);
require_once(__DIR__ . '/user.class.php');

class Status{
    public string $creator;
    public string $name;

    public function __construct(string $creator, string $name){
        $this->creator = $creator;
        $this->name = $name;
    }

    static function getStatuses(PDO $db) : ?array{
        $stmt = $db->prepare('SELECT adminID, name
        FROM Status');
        $statuses = array();
        $stmt->execute(array());
        while($status = $stmt->fetch()){
            $name = User::getName($db, (int)$status['adminID']);
            $statuses[] = new Status(
                $name,
                $status['name']
            );
        } 
        return $statuses;
    }

    static function addStatus(PDO $db, int $admin_id, string $name){
        $stmt = $db->prepare('INSERT INTO Status(adminID, name) VALUES (?,?)');
        $stmt->execute(array($admin_id, $name));
        return;
    }
}

?>