<?php

require_once '/src/User.php';
require_once '/src/conn_to_twitter.php';

if ($_SERVER['REQUEST_METHOD'] = "POST") {
    if (isset($_POST['userId'])) {
        unset($_SESSION['userId']);
        $_SESSION = array();
    }

    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
} 
    session_destroy();
    
    header('Location: login.php');
}

