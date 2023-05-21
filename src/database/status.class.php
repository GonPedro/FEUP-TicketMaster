<?php

declare(strict_types = 1);
require_once(__DIR__ . '/user.class.php');

class Status{
    public int $id;
    public string $creator;
    public string $name;

    public function __construct(int $id, string $creator, string $name){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
    }

    static function checkName(PDO $db, string $name){
        $stmt = $db->prepare('SELECT name
        FROM Status
        WHERE name = ?');
        $stmt->execute(array($name));
        if($status = $stmt->fetch()){
            return false;
        } else return true;
    }
    
    static function getStatuses(PDO $db) : ?array{
        $stmt = $db->prepare('SELECT statusID,adminID, name
        FROM Status');
        $statuses = array();
        $stmt->execute(array());
        while($status = $stmt->fetch()){
            $name = User::getName($db, (int)$status['adminID']);
            $statuses[] = new Status(
                (int)$status['statusID'],
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

    static function deleteStatus(PDO $db, int $status_id){
        $stmt = $db->prepare('DELETE FROM Status WHERE statusID = ?');
        $stmt->execute(array($status_id));
        return;
    }
}

?>