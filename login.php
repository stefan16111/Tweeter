<?php
require_once '/src/conn_to_twitter.php';
require_once '/src/User.php';
session_start();

if($_SERVER['REQUEST_METHOD'] = "POST") {
    if(isset($_POST['email']) && strlen(trim($_POST['email'])) >=5 
            && isset($_POST['password']) && strlen(trim($_POST['password'])) > 3) {       
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
      
        $user = User::login($conn_twitter, $email, $password);

        if($user) {
            $_SESSION['userId'] = $user->getId();
            $_SESSION['userName'] = $user->getName();
            header('Location: index.php');
        }else{
            echo "niepoprawne logowanie";
        }
    }
}
?>
<html>
    <head>
    </head>
    </body>
    Zaloguj : 
        <form action="#" method="POST">
            <label>Email : </label>
            <input type="text" name="email"><br>
            <label>haslo : </label>
            <input type="password" name="password"><br>
            <input type="submit" value="Wyslij">    
</form>
    <p>Rejestracja : <a href="register.php">Przejdz</a></p>
    </body>
</html>