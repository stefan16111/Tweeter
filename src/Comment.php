<?php
include_once 'conn_to_twitter.php';

class Comment {

    private $id;
    private $id_user;
    private $id_tweet;
    private $creation_date;
    private $text;

    public function __construct() {
        $this->id = -1;
        $this->id_user = "";
        $this->id_tweet = "";
        $this->creation_date = "";
        $this->text = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($userId) {
        $this->id_user = $userId;
    }
    
    public function getIdTweet() {
        return $this->id_tweet;
    }
    
    public function setIdTweet($idTweet) {
        return $this->id_tweet = $idTweet;
    }
    
    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        if (is_string($text)) {
            $this->text = $text;
        }
    }

    public function getCreationDate() {
        return $this->creation_date;
    }

    public function setCreationDate($date) {
        $this->creation_date = $date;
    }

    static public function loadCommentById(mysqli $connection, $id) {

        $selectTweet = "SELECT * FROM comments WHERE id=" . $connection->real_escape_string($id) . ";";
        $result = $connection->query($selectTweet);

        if ($result) {
            $row = $result->fetch_assoc();

            $loadComment = new Comment();
            $loadComment->id = $row['id'];
            $loadComment->setIdUser($row['user_id']);
            $loadComment->setIdTweet($row['tweet_id']);
            $loadComment->setText($row['text']);
            $loadComment->setCreationDate($row['creation_date']);

            return $loadComment;
        }
        return NULL;
    }

//    static public function loadAllTweets(mysqli $connection) {
//
//        $selectAllTweets = "SELECT * From tweets ORDER BY creationDate DESC;";
//        $result = $connection->query($selectAllTweets);
//
//        $allTweets = [];
//
//        if ($result) {
//            foreach ($result as $row) {
//
//                $loadTweet = new Tweet();
//                $loadTweet->id = $row['id'];
//                $loadTweet->setUserId($row['user_id']);
//                $loadTweet->setText($row['text']);
//                $loadTweet->setCreationDate($row['creationDate']);
//
//                $allTweets[] = $loadTweet;
//            }
//        }
//        return $allTweets;
//    }

    static public function loadAllCommentByTweetId(mysqli $connection, $tweet_id) {

        $selectAllCommentByTweetId = "SELECT * FROM comments WHERE tweet_id=" . $connection->real_escape_string($tweet_id) . " ORDER BY creation_date DESC;";
        $result = $connection->query($selectAllCommentByTweetId);

        $allComment = [];

        if ($result) {
            foreach ($result as $row) {

                $loadComment = new Comment();
                $loadComment->id = $row['id'];
                $loadComment->setIdUser($row['user_id']);
                $loadComment->setIdTweet($row['tweet_id']);
                $loadComment->setText($row['text']);
                $loadComment->setCreationDate($row['creation_date']);

                $allComment[] = $loadComment;
            }
        }
        return $allComment;
    }

    public function saveCommentToDB(mysqli $connection) {
        if ($this->id == -1) {

            $insertComment = "INSERT INTO comments(tweet_id, user_id, text, creation_date) VALUES ('$this->id_tweet', '$this->id_user', '$this->text', '$this->creation_date');";
            $result = $connection->query($insertComment);
            if ($result) {
                $this->id = $connection->insert_id;
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

}
