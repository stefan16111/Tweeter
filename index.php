<?php
session_start();

if(!isset($_SESSION['userId'])) {
    header('Location: login.php');
}
?>
<html>
    <head>
    </head>
        <body>
        Strona glowna
        1.Wszystkie wpisy uzytkowników
        2.Formularz do tworzenia nowego wpisu(przypisany do zalogowanego usera)
            <?php 
                if(isset($_SESSION['userId'])) {
                    echo '<a href="logout.php">Logout</a>';
                }
        
            ?>
        </body>  
</html>

