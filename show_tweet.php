<?php
require_once '/src/conn_to_twitter.php';
require_once '/src/User.php';
require_once '/src/Tweet.php';
require_once '/src/Comment.php';
session_start();
?>
<h5>Informacje o Wpisie : </h5>
<?php
$id = $_GET['tweetId'];
$tweets = Tweet::loadTweetById($conn_twitter, $id);
?>
<div style="border: 2px solid black; width: 20%" >
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
<div >
    <?php
    $comments = Comment::loadAllCommentByTweetId($conn_twitter, $id);
    foreach ($comments as $row) {
        ?>
        <div style="border: 1px solid black; width: 20%" >
            <table>
                <tr>
                    <td>
                        <?php echo $row->getIdUser(); ?>
                    </td>
                    <td>
                        <?php echo $row->getCreationDate(); ?>  
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $row->getText() ?></a>
                    </td>
                </tr>
            </table>
        </div>
    <?php } ?>
</div>
<div >
    <p>Dodaj komentarz : </p>        
    <form action = "#" method = "POST" >

        <input type="text" name = "commentText"/><br>
        <button type = "submit" name = "submit">Dodaj</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']) && !empty($_POST['commentText'])) {
        $newComment = new Comment();
        $newComment->setIdUser($_SESSION['userId']);
        $newComment->setIdTweet($id);
        $newComment->setText($_POST['commentText']);
        $newComment->setCreationDate(date("Y-m-d H:i:s"));
        $newComment->saveCommentToDB($conn_twitter);
echo var_dump($_POST['commentText']);
        header("Location: show_tweet.php?tweetId=".$id);
        exit;
    }
    ?>
</div>
