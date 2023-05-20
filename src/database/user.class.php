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

  static function getUserFromName(PDO $db, string $username) : ?User{
    $stmt = $db->prepare('SELECT userID, fullname, username, email
      FROM User
      WHERE username = ?');
    $stmt->execute(array($username));
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
    $stmt = $db->prepare('INSERT INTO User (fullname, username, password, email, closedTickets) VALUES ("Not set", ?, ?, ?, 0)');
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
    $stmt = $db->prepare('DELETE FROM Admin WHERE userID = ?');
    $stmt->execute(array($user_id));

    $stmt= $db->prepare('DELETE FROM Agent WHERE userID = ?');
    $stmt->execute(array($user_id));
    
    if($role == "agent"){
      $stmt = $db->prepare('INSERT INTO Agent VALUES (?)');
      $stmt->execute(array($user_id));
    } else if($role == "admin"){
      $stmt = $db->prepare('INSERT INTO Agent VALUES (?)');
      $stmt->execute(array($user_id));
      
      $stmt = $db->prepare('INSERT INTO Admin VALUES (?)');
      $stmt->execute(array($user_id));
    }
  }

  static function getClosedTickets(PDO $db, int $user_id) : ?int{
    $stmt = $db->prepare('SELECT closedTickets
    FROM User
    WHERE userID = ?');
    $stmt->execute(array($user_id));
    $tickets = $stmt->fetch();
    return (int)$tickets['closedTickets'];
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
