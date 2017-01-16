<?php
require_once '/src/conn_to_twitter.php';
require_once '/src/User.php';
require_once '/src/Tweet.php';
session_start();
?>
<h5>Informacje o Wpisie : </h5>
<?php
$id = $_GET['tweetId'];
    $tweets = Tweet::loadTweetById($conn_twitter, $id);
    ?>
        <div style="border: 1px solid black; width: 20%" >
            <table>
                <tr>
                    <td>
                        <?php echo $tweets->getUserId(); ?>
                    </td>
                    <td>
                        <?php echo $tweets->getCreationDate(); ?>  
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                            <?php echo $tweets->getText() ?></a>
                    </td>
                </tr>
            </table>
        </div>