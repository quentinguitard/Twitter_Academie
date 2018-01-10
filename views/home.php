<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 
$gertrude = new TweetManager($db);
$row = $gertrude->showTweets(6);
$gertrude->reTweet(1, $_SESSION['idUser']);
$countRow = count($row);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Tweet Academy</title>
</head>
    <body>
        <h1>VOILA</h1>

        <form method="post" action="">
            <input name="tweetContent" type="textarea">
            <input type="submit" name="envoyer" value="envoyer">
        </form>


        <h2>Joyeux Anniversaire</h2>
<?php 


$usermanager->select($_SESSION['idUser']);


if(!empty($_POST['envoyer'])){


    $bob = new Tweet($_SESSION['idUser'],$_POST['tweetContent']);

    var_dump($bob);

    $gertrude->postTweet($bob);

}





    for($i = 0 ; $i < $countRow; $i++){ ?>
    <h1><?php echo $row[$i]['displayName']; ?></h1>
    <p><?php echo $row[$i]['tweetContent']; ?></p>
    <?php
    }
    
?>

	</body>
</html>