<?php
declare(strict_types = 1);

class User {
    public int $id;
    public string $fullname;
    public string $username;
    public string $email;

  public function __construct(int $id, string $fullname, string $username, string $email){
      $this->id = $id;
      $this->fullname = $fullname;
      $this->username = $username;
      $this->email = $email;
    }

  static function getName(PDO $db, int $id) : ?string{
    $stmt = $db->prepare('SELECT username
    FROM User
    WHERE userID = ?');
    $stmt->execute(array($id));
    if($user = $stmt->fetch()){
      return $user['username'];
    }
  }

  static function getID(PDO $db, string $username) : ?int{
    $stmt = $db->prepare('SELECT userID
    FROM User
    WHERE username = ?');
    $stmt->execute(array($username));
    if($user = $stmt->fetch()){
      return (int)$user['userID'];
    }
  }

  static function findName(PDO $db, string $username) : ?bool{
    $stmt = $db->prepare('SELECT userID
    FROM User
    WHERE username = ?');
    $stmt->execute(array($username));
    if($user = $stmt->fetch()){
      return true;
    } else return false;
  }



  static function getUser(PDO $db, string $username, string $password) : ?User {
    $stmt = $db->prepare('SELECT userID, fullname, username, email
      FROM User
      WHERE lower(username) = ? AND password = ?');
    $stmt->execute(array(strtolower($username), sha1($password)));
    if($user = $stmt->fetch()){
      return new User(
        (int)$user['userID'],
        $user['fullname'],
        $user['username'],
        $user['email']
      );
    } else return null;
  }

  static function getUsers(PDO $db) : ?array {
    $stmt = $db->prepare('SELECT userID, fullname, username, email
      FROM User');
    $stmt->execute(array());
    $users = array();
    while($user = $stmt->fetch()){
      $users[] = new User(
        (int)$user['userID'],
        $user['fullname'],
        $user['username'],
        $user['email']
      );
    }
    return $users;
  }


  static function getUserFromID(PDO $db, int $id) : ?User{
    $stmt = $db->prepare('SELECT userID, fullname, username, email
      FROM User
      WHERE userID = ?');
    $stmt->execute(array($id));
    if($user = $stmt->fetch()){
      return new User(
        (int)$user['userID'],
        $user['fullname'],
        $user['username'],
        $user['email']
      );
    } else return null;
  }


  static function addUser(PDO $db, string $email, string $username, string $password) : ?User{
    $stmt = $db->prepare('INSERT INTO User (fullname, username, password, email) VALUES ("Not set", ?, ?, ?)');
    $stmt->execute(array(strtolower($username), sha1($password), strtolower($email)));
    return User::getUser($db, $username, $password);
  }


  static function getRole(PDO $db, int $user_id) : ?string{
    $stmt=$db->prepare('SELECT userID
    FROM Admin
    where userID = ?');
    $stmt->execute(array($user_id));
    if($stmt->fetch()){
      return "admin";
    }

    $stmt=$db->prepare('SELECT userID
    FROM Agent
    where userID = ?');
    $stmt->execute(array($user_id));

    if($stmt->fetch()){
      return "agent";
    } else {
      return "client";
    }

  }
  static function promote(PDO $db, int $user_id, string $role){
    if($role == "agent"){
      $stmt = $db->prepare('INSERT INTO Agent VALUES (?, 0)');
      $stmt->execute(array($user_id));
    } else if($role == "admin"){
      if(User::getRole($db, $user_id) == "client"){
        $stmt = $db->prepare('INSERT INTO Agent VALUES (?, 0)');
        $stmt->execute(array($user_id));
      }
      $stmt = $db->prepare('INSERT INTO Admin VALUES (?, 0)');
      $stmt->execute(array($user_id));
    }
  }

  static function depromote(PDO $db, int $user_id){
    if(User::getRole($db, $user_id) == "admin"){
      $stmt = $db->prepare('SELECT closedTickets
      FROM Admin
      WHERE userID = ?');
      $stmt->execute(array($user_id));
      $sub = $stmt->fetch();
      $tickets = (int)$sub['closedTickets'];
      $stmt = $db->prepare('UPDATE Agent SET closedTickets = ?
      WHERE $userID = ?');
      $stmt->execute(array($tickets));
      $stmt = $db->prepare('DELETE FROM Admin
      where adminID = ?');
      $stmt->execute(array($user_id));
    } else {
      $stmt = $db->prepare('DELETE FROM Agent
      where agentID = ?');
      $stmt->execute(array($user_id));
    }
    return;
  }

  static function getClosedTickets(PDO $db, int $user_id) : ?int{
    if(strcmp(User::getRole($db, $user_id), "admin") == 0){
      $stmt = $db->prepare('SELECT closedTickets
      FROM Admin
      WHERE userID = ?');
      $stmt->execute(array($user_id));
      $tickets = $stmt->fetch();
      return (int)$tickets['closedTickets'];
    } else {
      $stmt = $db->prepare('SELECT closedTickets
      FROM Agent
      WHERE userID = ?');
      $stmt->execute(array($user_id));
      $tickets = $stmt->fetch();
      return (int)$tickets['closedTickets'];
    }
  }


  function save(PDO $db, string $password){
    if(strcmp($password, "") == 0){
      $stmt = $db->prepare('UPDATE User SET fullname = ?, username = ?, email = ?
      WHERE userID = ?');
      $stmt->execute(array($this->fullname, $this->username, $this->email, $this->id));
    } else {
      $stmt = $db->prepare('UPDATE User SET fullname = ?, username = ?, email = ?, password = ?
      WHERE userID = ?');
      $stmt->execute(array($this->fullname, $this->username, $this->email, sha1($password), $this->id));
    }
  }



}
?>
