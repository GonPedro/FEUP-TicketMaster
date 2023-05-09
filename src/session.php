<?php

Class Session {
    private array $messages;


    public function __construct(){
        session_start();
        $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
        unset($_SESSION['messages']); 
    }

    public function isLoggedin() : bool {
        return isset($_SESSION['id']);
    }

    public function logout() {
        session_destroy();
    }

    public function getMessages(){
        return $this->messages;
    }

    public function addMessage(string $type, string $content){
        $_SESSION['messages'][] = array('type' => $type, 'content' => $content);
    }

    public function setID(int $id){
        $_SESSION['id'] = $id;
    }

    public function getID(){
       return $_SESSION['id'];
    }

    public function setName(string $name){
        $_SESSION['name'] = name;
    }
}
?>