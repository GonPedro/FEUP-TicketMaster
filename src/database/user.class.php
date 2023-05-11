<?php

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


  static function getUser(PDO $db, string $username, string $password) : ?User {
    $stmt = $db->prepare('SELECT userID, firstname, lastname, username, email
      FROM User
      WHERE lower(username) = ? AND password = ?');
    $stmt->execute(array(strtolower($username), sha1($password)));
    if($user = $stmt->fetch()){
      return new User(
        $user['userID'],
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
        $user['userID'],
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

  static function promoteClient(PDO $db, int $user_id){
    $stmt = $db->prepare('INSERT INTO Agent VALUES (?)');
    $stmt->execute(array($user_id));
  }

  static function promoteAgent(PDO $db, int $user_id){
    $stmt = $db->prepare('INSERT INTO Admin VALUES (?)');
    $stmt->execute(array($user_id));
  }


  function save(PDO $db){
    $stmt = $db->prepare('UPDATE User SET firstname = ?, lastname = ?, username = ?, email = ?
    WHERE userID = ?');
    $stmt->execute(array($user->firstname, $user->lastname, $user->username, $user->email, $user->id));
  }



}
?>
