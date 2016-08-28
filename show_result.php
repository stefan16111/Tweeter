<?php
include_once '/src/User.php';
include_once '/src/conn_to_twitter.php';

$user1 = new User();
$user1->setName('Jacek');
$user1->setEmail('jacek@wp.pl');
$user1->setPassword('haslojacka');

var_dump($user1->saveToDB($conn_twitter));

$conn_twitter->close();
$conn_twitter = null;