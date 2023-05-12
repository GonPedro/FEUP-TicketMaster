<?php

require_once(__DIR__ . '/user.class.php');

class Department{
    public int $id;
    public string $creator;
    public string $name;


    public function __construct(int $id, string $creator, string $name){
        $this->id = $id;
        $this->creator = $creator;
        $this->name = $name;
    }

    static function getDepartments(PDO $db) : ?array{
        $stmt = $db->prepare('SELECT departmentID, adminID, name
        FROM Department');
        $stmt->execute();
        $departments = array();
        while($department = $stmt->fetch()){
            $name = User::getName($db, $department['adminID']);
            $departments[] = new Department(
                $department['departmentID'],
                $name,
                $department['name']
            );
        }
        return $departments;
    }

    static function getDepartment(PDO $db, int $id) : ?Department{
        $stmt = $db->prepare('SELECT departmentID, adminID, name
        FROM Department
        WHERE departmentID = ?');
        $stmt->execute(array($id));
        if($department = $stmt->fetch()){
            $name = User::getName($db, $department['adminID']);
            return new Department(
                $department['departmentID'],
                $name,
                $department['name']
            );
        }
        else return null;
    }

    static function addDepartment(PDO $db, string $name, int $creator){
        $stmt = $db->prepare('INSERT INTO Department(adminID, name) VALUES (?,?)');
        $stmt->execute(array($creator, $name));
        return;
    }

}

?>