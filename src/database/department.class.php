<?php
declare(strict_types = 1);

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
            $name = User::getName($db, (int)$department['adminID']);
            $departments[] = new Department(
                (int)$department['departmentID'],
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
            $name = User::getName($db, (int)$department['adminID']);
            return new Department(
                (int)$department['departmentID'],
                $name,
                $department['name']
            );
        }
        else return null;
    }


    static function getAgentDepartments(PDO $db, int $agent_id) : ?array{
        $stmt = $db->prepare('SELECT Department.departmentID, adminID, name
        FROM Department, AgentDepartment
        WHERE Department.departmentID = AgentDepartment.departmentID AND AgentDepartment.agentID = ?');
        $stmt->execute(array($agent_id));
        $departments = array();
        while($department = $stmt->fetch()){
            $name = User::getName($db, (int)$department['adminID']);
            $departments[] = new Department(
                (int)$department['departmentID'],
                $name,
                $department['name']
            );
        }
        return $departments;
    }

    static function getDepartmentAgents(PDO $db, int $department_id) :? array {
        $stmt = $db->prepare('SELECT agentID
        FROM AgentDepartment
        where departmentID = ?');
        $agents = array();
        $stmt->execute(array($department_id));
        while($agent = $stmt->fetch()){
            $agents[] = User::getUserFromID($db, (int)$agent['agentID']);
        }
        return $agents;
    }

    static function addDepartment(PDO $db, int $creator, string $name){
        $stmt = $db->prepare('INSERT INTO Department(adminID, name) VALUES (?,?)');
        $stmt->execute(array($creator, $name));
        return;
    }

    static function getDepartmentName(PDO $db, int $id) : ?string{
        $stmt = $db->prepare('SELECT name
        FROM Department
        WHERE departmentID = ?');
        $stmt->execute(array($id));
        if($department = $stmt->fetch()){
            return $department['name'];
        }
        else return null;
    }
}

?>