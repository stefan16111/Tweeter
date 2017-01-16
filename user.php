<?php
require_once '/src/conn_to_twitter.php';
require_once '/src/User.php';
require_once '/src/Tweet.php';
session_start();

?>
Strona uzytkownika

<h5>Moje wpisy :</h5> 
<?php
    $tweetsArray = Tweet::loadAllTweetsByUserId($conn_twitter, $_SESSION['userId']);
    var_dump($tweetsArray);
    foreach ($tweetsArray as $row) {
        ?>
        <div style="border: 1px solid black; width: 20%" >
            <table>
                <tr>
                    <td>
                        <?php echo $row->getUserId(); $row->getId();?>
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
