<?php
require_once '/src/conn_to_twitter.php';
require_once '/src/User.php';
require_once '/src/Tweet.php';
session_start();

if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
}
?>
<html>
    <head>
    </head>
    <body>
        Strona glowna
        <?php
        if (isset($_SESSION['userId'])) {
            ?>
            <a href="user.php">Uzytkownik</a>
            <a href="logout.php">Logout</a>
            
            
            <p>Nowy wpis : </p>        
            <form action = "#" method = "POST" >
                
                <textarea name = "tweetText" rows="3" cols="30"/>
            </textarea><br>
            <button type = "submit" name = "submit">Dodaj</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $newTweet = new Tweet();
            $newTweet->setUserId($_SESSION['userId']);
            $newTweet->setText($_POST['tweetText']);
            $newTweet->setCreationDate(date("Y-m-d H:i:s"));
            $newTweet->saveTweetsToDB($conn_twitter);
        }
    }
    ?>
    <p>Wszystkie wpisy :</p>
    <?php
    $tweetsArray = Tweet::loadAllTweets($conn_twitter);
    foreach ($tweetsArray as $row) {
        ?>
        <div style="border: 1px solid black; width: 20%" >
            <table>
                <tr>
                    <td>
                        <?php echo $row->getUserId(); ?>
                    </td>
                    <td>
                        <?php echo $row->getCreationDate(); ?>  
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="show_tweet.php?tweetId=<?php echo $row->getId(); ?>" style="text-decoration: none">
                            <?php echo mb_strimwidth($row->getText(),0,30, "..."); ?></a>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }
    ?>
</body>  
</html>

