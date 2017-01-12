<?php
require_once '/src/User.php';
require_once '/src/conn_to_twitter.php';

if($_SERVER['REQUEST_METHOD'] = "POST") {
    if(isset($_POST['userId']) ) {
        unset($_SESSION['userID']);
    }
    header('Location : login.php');
}

