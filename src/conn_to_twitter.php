<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "twitter";

$conn_twitter = new mysqli($servername, $username, $password, $database);

if($conn_twitter->connect_error) {
    die("Connecr error : " . $conn_twitter->connect_error);
}

$conn_twitter->set_charset('utf8');