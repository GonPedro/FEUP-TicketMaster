<?php

class User {
    public int $id;
    public string $username;
    public string $email;

public function __construct(int $id, string $username, string $email){
      $this->id = $id;
      $this->username = $username;
      $this->email = $email;
    }


    static function getUser(PDO $db, string $username, string $password) : ?User {
      $stmt = $db->prepare('SELECT userID, username, email
        FROM User
        WHERE lower(username) = ? AND password = ?');
      $stmt->execute(array(strtolower($username), sha1($password)));
      if($user = $stmt->fetch()){
        return new User(
          $user['userID'],
          $user['username'],
          $user['email']
        );
      } else return null;
    }


    static function addUser(PDO $db, string $email, string $username, string $password) : ?User{
      $stmt = $db->prepare('INSERT INTO User (username, password, email) VALUES (?, ?, ?)');
      $stmt->execute(array(strtolower($username), sha1($password), strtolower($email)));
      return User::getUser($db, $username, $password);
    }
  }

?>
