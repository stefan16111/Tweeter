<?php
include_once 'conn_to_twitter.php';

class Tweet {
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->text = "";
        $this->creationDate = "";
    }
    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function getText() {
        return $this->text;
    }
    public function setText($text) {
        if(is_string($text)) {
            $this->text = $text;
        }
    }
    public function getCreationDate() {
        return $this->creationDate;
    }
    public function setCreationDate($date) {
        $this->creationDate = $date;
    }

    public function loadTweetById(mysqli $connection, $id) {
        
        $selectTweet = "SELECT * FROM tweet WHERE id=".$connection->real_escape_string($id).";";        
        $result = $connection->query($selectTweet);
        
        if($result) {
            $row = $result->fetch_assoc();
            
            $loadTweet = new Tweet();
            $loadTweet->id = $row['id'];
            $loadTweet->setUserId($row['userId']);
            $loadTweet->setText($row['text']);
            $loadTweet->setCreationDate($row['creationDate']);
            
            return $loadTweet;
        }
        return NULL;
    }
    public function loadAllTweets(mysqli $connection) {
        
        $selectAllTweets = "SELECT * FROM tweet;";
        $result = $connection->query($selectAllTweets);
        
        $allTweets = [];
        
        if($result) {
            foreach ($result as $row) {
            
            $loadTweet = new Tweet();
            $loadTweet->id = $row['id'];
            $loadTweet->setUserId($row['userId']);
            $loadTweet->setText($row['text']);
            $loadTweet->setCreationDate($row['creationDate']);
            
            $allTweets[] = $loadTweet;
            }    
        }
        return $allTweets;
    }
    public function loadAllTweetsByUserId(mysqli $connection, $userId) {
        
        $selectAllTweetByUserId = "SELECT * FROM tweet WHERE userId=".$connection->real_escape_string($userId).";";
        $result = $connection->query($selectAllTweetByUserId);
        
        $allUserTweets = [];
        
        if($result) {
            foreach ($result as $row) {
            
            $loadTweet = new Tweet();
            $loadTweet->id = $row['id'];
            $loadTweet->setUserId($row['userId']);
            $loadTweet->setText($row['text']);
            $loadTweet->setCreationDate($row['creationDate']);
            
            $allUserTweets[] = $loadTweet;
            }    
        }
        return $allUserTweetsTweets;
    }
    public function saveTweetsToDB(mysqli $connection) {
        if($this->id == -1) {
            $insertTweet = "INSERT INTO tweets(userId, text, creationDate) VALUES ('$this->userId', '$this->text', CURRENT_TIMESTAMP);";
        
            $result = $connection->query($insertTweet);
            if($result) {
                $this->id = $connection->insert_id;
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }
    
}
