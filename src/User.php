<?php
include_once 'conn_to_twitter.php';

class User {
    private $id;
    private $email;
    private $username;
    private $hash_password;
    
    public function __construct() {
        $this->id = -1;
        $this->email = "";
        $this->username = "";
        $this->hash_password = "";
    }            
    public function getId() {
        return $this->id;
    }
    public function setName($name) {
        if(is_string($name) && strlen(trim($name)) > 0) {
            $this->username = trim($name);
        }
    }
    public function getName() {
        return $this->username;
    }
    public function setEmail($email) {
        if(is_string($email) && strlen(trim($email)) >= 5) {
            $this->email = trim($email);
        }
    }
    public function getEmail() {
        return $this->email;
    }
    public function setPassword($password) {
        if(is_string($password) && strlen(trim($password)) > 3) {
            $this->hash_password = password_hash($password, PASSWORD_DEFAULT);
        }
    }
    
    public function saveToDB(mysqli $connection) {
        if($this->id == -1) {
            $insertInUsers = "INSERT INTO users(email, username, hash_password) VALUES ('$this->email','$this->username','$this->hash_password');";
            
            if($connection->query($insertInUsers)) {
                $this->id = $connection->insert_id;
                return TRUE;
            }  else {
                return FALSE;
            }
        }
    }
    
    
}

