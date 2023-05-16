<?php
declare(strict_types = 1);

class User {
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $username;
    public string $email;

  public function __construct(int $id, string $firstname, string $lastname, string $username, string $email){
      $this->id = $id;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
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
      return $user;
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
    $stmt = $db->prepare('SELECT userID, firstname, lastname, username, email
      FROM User
      WHERE lower(username) = ? AND password = ?');
    $stmt->execute(array(strtolower($username), sha1($password)));
    if($user = $stmt->fetch()){
      return new User(
        (int)$user['userID'],
        $user['firstname'],
        $user['lastname'],
        $user['username'],
        $user['email']
      );
    } else return null;
  }


  static function getUserFromID(PDO $db, int $id) : ?User{
    $stmt = $db->prepare('SELECT userID, firstname, lastname, username, email
      FROM User
      WHERE userID = ?');
    $stmt->execute(array($id));
    if($user = $stmt->fetch()){
      return new User(
        (int)$user['userID'],
        $user['firstname'],
        $user['lastname'],
        $user['username'],
        $user['email']
      );
    } else return null;
  }


  static function addUser(PDO $db, string $email, string $username, string $password) : ?User{
    $stmt = $db->prepare('INSERT INTO User (username,firstname, lastname, password, email) VALUES (?, "", "", ?, ?)');
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
      $stmt = $db->prepare('INSERT INTO Agent VALUES (?)');
      $stmt->execute(array($user_id));
    } else if($role == "admin"){
      if(User::getRole($db, $user_id) == "client"){
        $stmt = $db->prepare('INSERT INTO Agent VALUES (?)');
        $stmt->execute(array($user_id));
      }
      $stmt = $db->prepare('INSERT INTO Admin VALUES (?)');
      $stmt->execute(array($user_id));
    }
  }

  static function depromote(PDO $db, int $user_id){
    if(User::getRole($db, $user_id) == "admin"){
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


  function save(PDO $db){
    $stmt = $db->prepare('UPDATE User SET firstname = ?, lastname = ?, username = ?, email = ?
    WHERE userID = ?');
    $stmt->execute(array($user->firstname, $user->lastname, $user->username, $user->email, $user->id));
  }



}
?>
