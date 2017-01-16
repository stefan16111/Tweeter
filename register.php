<?php
require_once '/src/User.php';
require_once '/src/conn_to_twitter.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (User::loadUserByEmail($conn_twitter, $_POST['email']) == NULL) {
        if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 0 && isset($_POST['email']) && strlen(trim($_POST['email'])) >= 5 && isset($_POST['password']) && strlen(trim($_POST['password'])) > 3 && isset($_POST['retype_password']) && trim($_POST['password']) == trim($_POST['retype_password'])) {

            $user = new User();
            $user->setName($_POST['name']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            if ($user->saveToDB($conn_twitter)) {
                echo "Udalo sie zarrejestrowac";
                header('Location: login.php');
            } else {
                echo "Blad rejestracji";
            }
        } else {
            echo "Bledne dane rejestracji";
        }
    }
    echo "taki email juz istnieje";
}
?>

<html>
    <head></head>
    <body>
        <form action="register.php" method="POST">
            <label>Name : </label>
            <input type="text" name="name"><br>
            <label>Email : </label>
            <input type="text" name="email"><br>
            <label>Haslo : </label>
            <input type="password" name="password"><br>
            <label>Powtorz haslo : </label>
            <input type="password" name="retype_password"><br>
            <input type="submit" value="Wyslij">
        </form>       
    </body>   
</html>
