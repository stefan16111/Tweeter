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
            $insertInUsers = "INSERT INTO users(name, email, password) VALUES ('$this->username','$this->email','$this->hash_password');";
            
            if($connection->query($insertInUsers)) {
                $this->id = $connection->insert_id;
                return TRUE;
            }  else {
                return FALSE;
            }
        }else{
            $updateUsers = "UPDATE users SET username='$this->username', email='$this->email', hash_password='$this->hash_password' WHERE id=$this->id;";
            
            $result = $connection->query($updateUsers);
            if($result) {
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }
    
    static public function loadUserById(mysqli $connection, $id) {
        $selectUser = "SELECT * FROM users WHERE id=".$connection->real_escape_string($id).";";
        
        $result = $connection->query($selectUser);
        
        if($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadUser = new User();
            $loadUser->id = $row['id'];
            $loadUser->setName($row['username']);
            $loadUser->setEmail($row['email']);
            $loadUser->hash_password = $row['hash_password'];
            
            return $loadUser;
        }
        return NULL;
    }
    
    static public function loadAllUsers(mysqli $connection) {
        $selectAllUsers = "SELECT * FROM users;";
        
        $result = $connection->query($selectAllUsers);
        $allUsers = [];
        
        if($result) {
            foreach ($result as $row) {
                $loadUser = new User();
                $loadUser->id = $row['id'];
                $loadUser->setName($row['username']);
                $loadUser->setEmail($row['email']);
                $loadUser->hash_password = $row['hash_password'];
                
                $allUsers[] = $loadUser;
            }
        }
        return $tabUsers;
    }
    
    public function delete(mysqli $connection) {
        if($this->id != -1) {
            $deleteUser = "DELETE FROM users WHERE id='$this->id';";
            
            if($connection->query($deleteUser)) {
                $this->id = -1;
                return TRUE;
            }else{
                return FALSE;
            }
        }
        return TRUE;
    }
    
    static public function loadUserByEmail(mysqli $connection, $email) {
        $loadUser = "SELECT * FROM users WHERE email = '".$connection->real_escape_string($email)."';";

        $result = $connection->query($loadUser);
      
        if($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->id = $row['id'];
            $user->setName($row['name']);
            $user->setEmail($row['email']);
            $user->hash_password = $row['password'];
            
            return $user;    
        }
        return NULL;
    }
    
    static public function login(mysqli $connection, $email, $password) {
        $user = self::loadUserByEmail($connection, $email);
        
        if($user && password_verify($password, $user->hash_password)){
            return $user;
        }else{
            return FALSE;
        }    
    }
}

