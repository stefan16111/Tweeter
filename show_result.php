<?php
include_once '/src/User.php';
include_once '/src/conn_to_twitter.php';
echo "Tworzenie user i wrzucanie go do BD";
//$user1 = new User();
//$user1->setName('Jacek');
//$user1->setEmail('jacek@wp.pl');
//$user1->setPassword('jacek');
//var_dump($user1->saveToDB($conn_twittern));

//echo "pobieranie usera z BD";
//$user = User::loadUserById($conn_twitter, 1);
//var_dump($user);

//echo "pobieranoie wszystkich userow";
//$users = User::loadAllUsers($conn_twitter);
//var_dump($users);

//echo "modyfikacja uzytkownika";
//$user = User::loadUserById($conn_twitter, 1);
//$user->setName('Zbyszek');
//var_dump($user->saveToDB($conn_twitter));
//$user = User::loadUserById($conn_twitter, 1);
//var_dump($user);

//echo "usuwanie usera";
//$user = User::loadUserById($conn_twitter, 2);
//var_dump($user->delete($conn_twitter));
//var_dump($user);

$conn->close();
$conn = null;